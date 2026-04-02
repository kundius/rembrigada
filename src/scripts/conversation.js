function initConversation() {
  const conversion = document.querySelector("[data-conversion]");
  console.log(conversion);

  if (!conversion) return;

  const btn = conversion.querySelector("[data-conversion-btn]");
  console.log(btn);

  if (!btn) return;

  const icons = btn.querySelectorAll("[data-conversion-btn-icon]") || [];
  console.log(icons);

  if (icons.length > 0) {
    const iconSwitch = (index) => {
      icons.forEach((el) => el.classList.remove("active"));
      icons[index].classList.add("active");

      icons.forEach((el) => el.classList.remove("show-icon"));
      setTimeout(() => {
        icons[index].classList.add("show-icon");
        setTimeout(() => {
          const nextIndex = index == icons.length - 1 ? 0 : index + 1;
          setTimeout(() => iconSwitch(nextIndex), 10000);
        }, 250);
      }, 250);
    };
    iconSwitch(icons.length - 1, 0);
  }
}

export { initConversation };
