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
      console.log(index);
      icons.forEach((el) => el.classList.remove("active"));
      icons[index].classList.add("active");
      const nextIndex = index == icons.length - 1 ? 0 : index + 1;
      setTimeout(() => iconSwitch(nextIndex), 2000);
    };
    iconSwitch(0);
  }
}

export { initConversation };
