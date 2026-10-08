document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".form-wizard");
  if (!form) return;

  const steps = Array.from(form.querySelectorAll(".cadastro_evento"));
  const btnAvancarList = form.querySelectorAll(".btn_avancar");
  const btnVoltarList = form.querySelectorAll(".btn_voltar");

  let currentStep = 0;

  const updateSteps = () => {
    steps.forEach((step, index) => {
      if (index === currentStep) {
        step.removeAttribute("hidden");
        step.classList.add("active");
      } else {
        step.setAttribute("hidden", "");
        step.classList.remove("active");
      }
    });
  };

  const validateCurrentStep = () => {
    const currentFields = steps[currentStep].querySelectorAll("input, select, textarea");
    for (const field of currentFields) {
      if (!field.checkValidity()) {
        field.reportValidity(); 
        return false;
      }
    }
    return true;
  };

  btnAvancarList.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      if (validateCurrentStep()) {
        if (currentStep < steps.length - 1) {
          currentStep++;
          updateSteps();
        }
      }
    });
  });


  btnVoltarList.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      if (currentStep > 0) {
        currentStep--;
        updateSteps();
      }
    });
  });

  updateSteps();
});