import forEach from "lodash/forEach";

/**
 * Новый движок квиза.
 * - Шаги задаются разметкой: [data-quiz-screen][data-step-key][data-step-type].
 * - Типы: radio | checkbox | finish | success.
 * - Ветвление: data-option-next = ключ шага | "finish" | "" (= следующий по порядку).
 * - Без автовперёд: кнопка Далее disabled, пока ничего не выбрано.
 * - Прогресс пересчитывается от текущего пути: пройденное + прогулка
 *   вперёд от выбранного шага (выбор учитывается, дальше — по умолчанию).
 * - Перед submit упаковываем ответы в [data-quiz-result] (quiz_result для CF7).
 */

const stripTags = (s) => String(s == null ? "" : s).replace(/<[^>]*>/g, "").trim();

function collectStepScreens(container) {
  const screens = Array.from(container.querySelectorAll("[data-quiz-screen]"));
  const byKey = {};
  const questions = [];
  let finish = null;
  let success = null;
  screens.forEach((el) => {
    const key = el.getAttribute("data-step-key") || "";
    const type = el.getAttribute("data-step-type") || "radio";
    byKey[key] = el;
    if (type === "finish") finish = el;
    else if (type === "success") success = el;
    else questions.push(el);
  });
  return { screens, byKey, questions, finish, success };
}

function nextKeyAfter(container, byKey, questions, screen, selectedNexts) {
  // selectedNexts: массив data-option-next выбранных опций шага.
  let next = "";
  if (selectedNexts.length === 1) {
    next = (selectedNexts[0] || "").trim();
  } else if (selectedNexts.length > 1) {
    // Checkbox: если все выборы ведут в одно место — идём туда,
    // иначе приоритет первому непустому next, иначе линейно.
    const nonEmpty = selectedNexts.map((s) => (s || "").trim()).filter(Boolean);
    const uniq = Array.from(new Set(nonEmpty));
    if (uniq.length === 1) next = uniq[0];
    else if (uniq.length > 1) next = uniq[0];
    else next = "";
  }
  if (next === "" || next === "auto") {
    const idx = questions.indexOf(screen);
    if (idx !== -1 && idx + 1 < questions.length) {
      return questions[idx + 1].getAttribute("data-step-key") || "";
    }
    return "__finish";
  }
  if (next === "finish" || next === "__finish") return "__finish";
  if (byKey[next]) return next;
  // Неизвестный ключ — fallback на следующий по порядку.
  const idx = questions.indexOf(screen);
  if (idx !== -1 && idx + 1 < questions.length) {
    return questions[idx + 1].getAttribute("data-step-key") || "";
  }
  return "__finish";
}

function defaultSuccKey(byKey, questions, screen) {
  // Наследник шага по умолчанию: next первой опции, иначе следующий по порядку.
  const first = screen.querySelector("[data-option-next]");
  const nv = first ? (first.getAttribute("data-option-next") || "").trim() : "";
  if (nv === "" || nv === "auto") {
    const idx = questions.indexOf(screen);
    if (idx !== -1 && idx + 1 < questions.length) {
      return questions[idx + 1].getAttribute("data-step-key") || "";
    }
    return "__finish";
  }
  if (nv === "finish" || nv === "__finish") return "__finish";
  if (byKey[nv]) return nv;
  // Неизвестный ключ — fallback на следующий по порядку.
  const idx = questions.indexOf(screen);
  if (idx !== -1 && idx + 1 < questions.length) {
    return questions[idx + 1].getAttribute("data-step-key") || "";
  }
  return "__finish";
}

function tailKeys(byKey, questions, startKey, stopKeys) {
  // Честная прогулка вперёд от startKey: каждый следующий шаг — по умолчанию.
  // Учитывает и шаги после ветки, идущие дальше по порядку.
  const tail = [];
  const seen = new Set(stopKeys || []);
  let cur = startKey;
  let guard = 0;
  while (cur && !seen.has(cur) && guard++ < 60) {
    seen.add(cur);
    tail.push(cur);
    if (cur === "__finish" || cur === "__success") break;
    const sc = byKey[cur];
    if (!sc) break;
    cur = defaultSuccKey(byKey, questions, sc);
  }
  return tail;
}

function selectedOptions(screen) {
  return Array.from(screen.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked')).map((input) => {
    const label = input.closest("label");
    const textInput = label ? label.querySelector("[data-option-input]") : null;
    const title = input.getAttribute("data-option-title") || stripTags(input.value);
    const extra = textInput ? textInput.value.trim() : "";
    return {
      input,
      title,
      extra,
      // Пустой ввод тоже отправляется: «Ответ: » с пустой строкой.
      text: textInput ? title + ": " + extra : title,
      next: input.getAttribute("data-option-next") || "",
    };
  });
}

function stepIsValid(screen) {
  return selectedOptions(screen).length > 0;
}

function questionText(screen) {
  const t = screen.querySelector(".quiz-form__title-text");
  return t ? stripTags(t.textContent) : "Вопрос";
}

function buildResult(history, byKey) {
  const parts = [];
  history.forEach((key) => {
    const screen = byKey[key];
    if (!screen) return;
    const type = screen.getAttribute("data-step-type");
    if (type === "finish" || type === "success") return;
    const sel = selectedOptions(screen);
    if (!sel.length) return;
    parts.push(questionText(screen) + ": " + sel.map((s) => s.text).join(", "));
  });
  return parts.join("; ");
}

function renderProgress(container, stepsBar, history, byKey, questions, currentKey) {
  if (!stepsBar) return;
  // Оставшаяся цепочка: от выбранного следующего шага идём вперёд
  // по умолчанию — учитываются и шаги после ветки по порядку.
  const curScreen = byKey[currentKey];
  let remaining = [];
  if (curScreen && curScreen.getAttribute("data-step-type") !== "finish" && curScreen.getAttribute("data-step-type") !== "success") {
    const sel = selectedOptions(curScreen).map((s) => s.next);
    const firstOpt = curScreen.querySelector("[data-option-next]");
    const nk = nextKeyAfter(container, byKey, questions, curScreen, sel.length ? sel : [firstOpt ? firstOpt.getAttribute("data-option-next") : ""]);
    remaining = tailKeys(byKey, questions, nk, history.concat([currentKey]));
  } else if (currentKey === "__finish") {
    remaining = ["__finish"];
  }
  const visited = history.slice();
  if (visited[visited.length - 1] !== currentKey) visited.push(currentKey);
  // total = пройдено (без дублей finish) + хвост без текущего
  const seenTail = remaining.filter((k) => k !== currentKey);
  const total = visited.filter((k) => k !== "__success").length + seenTail.filter((k) => k !== "__success").length;
  const activePos = visited.filter((k) => k !== "__success").length;

  stepsBar.innerHTML = "";
  for (let i = 0; i < total; i++) {
    if (i > 0) {
      const line = document.createElement("div");
      line.className = "quiz-steps__line" + (i < activePos ? " _active" : "");
      stepsBar.appendChild(line);
    }
    const item = document.createElement("div");
    const isGift = i === total - 1;
    item.className = "quiz-steps__item" + (i < activePos ? " _active" : "") + (isGift ? " quiz-steps__item_gift" : "");
    if (isGift) {
      item.setAttribute("data-quiz-step", "");
      item.innerHTML =
        '<svg xmlns="http://www.w3.org/2000/svg" width="34px" height="35px" viewBox="0 0 34 35"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M18.407,34.625 L31.286,34.625 C31.980,34.625 32.542,34.62 32.542,33.368 L32.542,22.440 L18.407,22.440 L18.407,34.625 ZM2.261,33.368 C2.261,34.62 2.824,34.625 3.518,34.625 L16.626,34.625 L16.626,22.440 L2.261,22.440 L2.261,33.368 ZM2.40,12.799 C1.346,12.799 0.783,13.362 0.783,14.56 L0.783,16.886 C0.783,17.580 1.346,18.143 2.40,18.143 L2.261,18.143 L2.261,20.659 L16.626,20.659 L16.626,12.799 L2.40,12.799 ZM28.620,2.992 C28.620,2.992 23.112,-4.674 17.719,8.481 C12.327,-4.674 6.818,2.992 6.818,2.992 C2.704,9.922 11.886,11.468 16.509,11.811 C16.498,11.844 16.487,11.876 16.477,11.908 C16.477,11.908 16.951,11.914 17.719,11.882 C18.488,11.914 18.962,11.908 18.962,11.908 C18.951,11.876 18.941,11.844 18.930,11.811 C23.553,11.468 32.735,9.922 28.620,2.992 ZM33.736,14.56 C33.736,13.362 33.174,12.799 32.480,12.799 L18.407,12.799 L18.407,20.659 L32.542,20.659 L32.542,18.140 C33.207,18.107 33.736,17.559 33.736,16.886 L33.736,14.56 Z"/></svg>';
    } else {
      item.setAttribute("data-quiz-step", "");
      item.textContent = String(i + 1);
    }
    stepsBar.appendChild(item);
  }
  // Нумерация маркеров вопросов по позиции в пути.
  let n = 0;
  visited.forEach((k) => {
    const sc = byKey[k];
    if (!sc) return;
    const t = sc.getAttribute("data-step-type");
    if (t === "finish" || t === "success") return;
    n += 1;
    const m = sc.querySelector("[data-quiz-marker]");
    if (m) m.textContent = String(n);
  });
}

export function applyQuiz(container) {
  const form = container.querySelector("[data-quiz-form]");
  if (!form) return;
  const { byKey, questions, finish, success } = collectStepScreens(container);
  if (!questions.length) return;
  const stepsBar = container.querySelector("[data-quiz-steps]");
  const resultInput = form.querySelector("[data-quiz-result]");

  let history = [];
  let currentKey = questions[0].getAttribute("data-step-key");

  const show = (key) => {
    currentKey = key;
    forEach(container.querySelectorAll("[data-quiz-screen]"), (el) => {
      el.classList.toggle("_active", el.getAttribute("data-step-key") === key);
    });
    renderProgress(container, stepsBar, history, byKey, questions, currentKey);
  };

  const refreshStep = (screen) => {
    const nextBtn = screen.querySelector("[data-quiz-next]");
    const err = screen.querySelector("[data-quiz-error]");
    const ok = stepIsValid(screen);
    if (nextBtn) {
      if (ok) nextBtn.removeAttribute("disabled");
      else nextBtn.setAttribute("disabled", "");
    }
    if (err) err.hidden = true;
  };

  const goNext = (screen) => {
    if (!stepIsValid(screen)) {
      const err = screen.querySelector("[data-quiz-error]");
      if (err) err.hidden = false;
      return;
    }
    const sel = selectedOptions(screen).map((s) => s.next);
    const nk = nextKeyAfter(container, byKey, questions, screen, sel);
    const key = screen.getAttribute("data-step-key");
    if (history[history.length - 1] !== key) history.push(key);
    show(nk);
  };

  const goPrev = () => {
    const prev = history.pop();
    if (prev === undefined) return;
    show(prev);
  };

  questions.forEach((screen) => {
    const nextBtn = screen.querySelector("[data-quiz-next]");
    const prevBtn = screen.querySelector("[data-quiz-previous]");
    if (nextBtn) {
      nextBtn.addEventListener("click", (e) => {
        e.preventDefault();
        goNext(screen);
      });
    }
    if (prevBtn) {
      prevBtn.addEventListener("click", (e) => {
        e.preventDefault();
        goPrev();
      });
    }
    screen.addEventListener("change", (e) => {
      const t = e.target;
      // Ввод в текстовый инпут должен выбирать родительскую опцию.
      if (t && t.hasAttribute && t.hasAttribute("data-option-input")) {
        const box = t.closest("label") ? t.closest("label").querySelector('input[type="radio"], input[type="checkbox"]') : null;
        if (box && !box.checked) {
          box.checked = true;
        }
      }
      refreshStep(screen);
      renderProgress(container, stepsBar, history, byKey, questions, currentKey);
    });
    screen.addEventListener("input", (e) => {
      const t = e.target;
      if (t && t.hasAttribute && t.hasAttribute("data-option-input")) {
        const box = t.closest("label") ? t.closest("label").querySelector('input[type="radio"], input[type="checkbox"]') : null;
        if (box && !box.checked) {
          box.checked = true;
        }
      }
      refreshStep(screen);
    });
    refreshStep(screen);
  });

  // Упаковка ответов перед отправкой в CF7.
  form.addEventListener("submit", () => {
    if (resultInput) {
      resultInput.value = buildResult(history.concat([currentKey]), byKey);
    }
  });

  form.addEventListener("wpcf7mailsent", () => {
    show("__success");
    if (finish) history = history.filter((k) => k !== "__finish");
  });

  if (history.length === 0) {
    show(questions[0].getAttribute("data-step-key"));
  }
}

export function initQuiz(root) {
  const scope = root || document;
  forEach(scope.querySelectorAll("[data-quiz]"), applyQuiz);
}
