const celsiusInput = document.querySelector("#celsius");
const convertButton = document.querySelector("#convert-button");
const result = document.querySelector("#result");

let celsiusValues = [];
let fahrenheitValues = [];

convertButton.addEventListener("click", () => {
const celsius = parseFloat(celsiusInput.value);

if (Number.isNaN(celsius)) {
  result.textContent = "Please enter a valid number.";
  return;
    }
 
const fahrenheit = (celsius * 9) / 5 + 32;

celsiusValues.push(celsius);
fahrenheitValues.push(fahrenheit);

result.textContent = `${celsius}°C = ${fahrenheit.toFixed(2)}°F`;


console.log("Celsius values:", celsiusValues);
console.log("Fahrenheit values:", fahrenheitValues);
      

      
});