function initConversation() {
  const conversion = document.querySelector("[data-conversion]");
  console.log(conversion);

  if (!conversion) return;

  const btn = conversion.querySelector("[data-conversion-btn]");
  console.log(btn);

  if (!btn) return;

  const icons = btn.querySelectorAll("[data-conversion-play]") || [];
  console.log(icons);

  if (icons.length > 0) {
    const iconSwitch = (index) => {
      icons.forEach((el) => el.classList.remove("animate-first"));
      setTimeout(() => {
        icons[index].classList.add("animate-first");
        icons.forEach((el) => el.classList.remove("animate-second"));
        // setTimeout(() => {
        icons[index].classList.add("animate-second");
        const nextIndex = index == icons.length - 1 ? 0 : index + 1;
        setTimeout(() => iconSwitch(nextIndex), 10000);
        // }, 5000);
      }, 5000);
    };
    iconSwitch(icons.length - 1, 0);
  }
}

export { initConversation };
