function initConversation() {
  const conversion = document.querySelector("[data-conversion]");

  if (!conversion) return;

  const btn = conversion.querySelector("[data-conversion-btn]");

  if (!btn) return;

  const icons = btn.querySelectorAll("[data-conversion-btn-icon]") || [];

  if (icons.length > 0) {
    const iconSwitch = (index) => {
      icons.forEach((el) => el.classList.remove("active"));
      icons[index].classList.add("active");

      icons.forEach((el) => el.classList.remove("show"));
      setTimeout(() => {
        icons[index].classList.add("show");
        const nextIndex = index == icons.length - 1 ? 0 : index + 1;
        setTimeout(() => iconSwitch(nextIndex), 3000);
      }, 250);
    };
    iconSwitch(0);
  }
}

export { initConversation };
