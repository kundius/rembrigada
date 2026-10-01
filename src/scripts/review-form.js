import forEach from "lodash/forEach";

const galleryAllowedTypes = ["image/jpeg", "image/png", "image/gif"];

export function applyReviewGalleryField(root) {
  const add = root.querySelector("[data-gallery-field-add]");
  if (!add || root.dataset.galleryFieldReady) return;
  root.dataset.galleryFieldReady = "1";

  add.addEventListener("click", () => {
    const tmpFileInput = document.createElement("input");
    tmpFileInput.type = "file";
    tmpFileInput.multiple = true;
    tmpFileInput.accept = galleryAllowedTypes.join(", ");
    tmpFileInput.classList.add("hidden");

    document.body.appendChild(tmpFileInput);
    tmpFileInput.click();

    tmpFileInput.addEventListener("change", () => {
      const files = Array.from(tmpFileInput.files || []);

      files.forEach((file) => {
        if (galleryAllowedTypes.indexOf(file.type) === -1) {
          alert('Файл "' + file.name + '" не является изображением.');
          return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
          const item = document.createElement("div");
          item.classList.add("gallery-field__item");

          const img = document.createElement("img");
          img.src = e.target.result;
          img.classList.add("gallery-field__item-image");
          img.alt = "";

          const deleteBtn = document.createElement("button");
          deleteBtn.type = "button";
          deleteBtn.innerHTML = '<span class="icon icon-close"></span>';
          deleteBtn.classList.add("gallery-field__item-remove");
          deleteBtn.setAttribute("aria-label", "Удалить фото");

          const itemFileInput = document.createElement("input");
          itemFileInput.type = "file";
          itemFileInput.name = "gallery[]";
          itemFileInput.setAttribute("tabindex", -1);
          itemFileInput.accept = galleryAllowedTypes.join(", ");
          itemFileInput.classList.add("gallery-field__item-input");
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          itemFileInput.files = dataTransfer.files;

          deleteBtn.addEventListener("click", () => {
            item.remove();
          });

          item.appendChild(img);
          item.appendChild(itemFileInput);
          item.appendChild(deleteBtn);
          root.insertBefore(item, add);
        };

        reader.readAsDataURL(file);
      });

      if (tmpFileInput.parentNode) {
        tmpFileInput.parentNode.removeChild(tmpFileInput);
      }
    });
  });
}

export function initReviewGalleryField() {
  forEach(document.querySelectorAll("[data-gallery-field]"), applyReviewGalleryField);
}

function sendReviewForm(form) {
  const errors = form.querySelector("[data-review-form-errors]");
  const submit = form.querySelector('[type="submit"]');
  const submitText = submit ? submit.textContent : null;

  if (errors) errors.innerHTML = "";
  form.removeAttribute("data-review-form-success");
  form.setAttribute("data-review-form-loading", "");
  if (submit) {
    submit.setAttribute("disabled", "");
    submit.textContent = "Отправка…";
  }

  const done = () => {
    form.removeAttribute("data-review-form-loading");
    if (submit) {
      submit.removeAttribute("disabled");
      if (submitText !== null) submit.textContent = submitText;
    }
  };

  const formData = new FormData(form);
  formData.append("action", form.dataset.reviewFormAction || "review_form");

  fetch(form.action, { method: "post", body: formData })
    .then((response) => response.json())
    .then((result) => {
      if (!result.success) {
        if (errors) {
          errors.innerHTML = Object.values(result.data || {}).join("<br>");
        }
      } else {
        form.setAttribute("data-review-form-success", "");
        form.reset();
        const galleryItems = form.querySelectorAll("[data-gallery-field] .gallery-field__item");
        forEach(galleryItems, (item) => item.remove());

        const goal = form.dataset.reviewFormGoal;
        if (goal && typeof ym !== "undefined") {
          ym(31338108, "reachGoal", goal);
        }
      }
      done();
    })
    .catch((error) => {
      if (errors) errors.innerHTML = "Ошибка отправки. Попробуйте позже.";
      done();
      // eslint-disable-next-line no-console
      console.error(error);
    });
}

export function applyReviewForm(form) {
  if (form.dataset.reviewFormReady) return;
  form.dataset.reviewFormReady = "1";

  forEach(form.querySelectorAll("[data-review-form-reset]"), (resetNode) =>
    resetNode.addEventListener("click", () => {
      const errors = form.querySelector("[data-review-form-errors]");
      if (errors) errors.innerHTML = "";
      form.removeAttribute("data-review-form-success");
      form.removeAttribute("data-review-form-loading");
      const submit = form.querySelector('[type="submit"]');
      if (submit) submit.removeAttribute("disabled");
    })
  );

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
      typeof grecaptcha !== "undefined" &&
      typeof wpcf7_recaptcha !== "undefined" &&
      wpcf7_recaptcha.sitekey
    ) {
      grecaptcha
        .execute(wpcf7_recaptcha.sitekey, { action: "submit" })
        .then(function (token) {
          const holder = form.querySelector("[data-recaptcha-response]");
          if (holder) holder.value = token;
          sendReviewForm(form);
        })
        .catch(function () {
          sendReviewForm(form);
        });
    } else {
      sendReviewForm(form);
    }
  });
}

export function initReviewForm() {
  forEach(document.querySelectorAll("[data-review-form]"), applyReviewForm);
}
