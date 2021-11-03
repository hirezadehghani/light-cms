// حالت شب
const btn = document.getElementById("nightcheck");
// nightstatus.addEventListener("click", function(){
//     document.body.classList.toggle("nightmode");
// });

// Select the button
// Check for night mode preference at the OS level
const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: night)");

// Get the user's theme preference from local storage, if it's available
const currentTheme = localStorage.getItem("theme");
// If the user's preference in localStorage is dark...
if (currentTheme == "night") {
  // ...let's toggle the .nightmode class on the body
  document.body.classList.toggle("nightmode");
  btn.checked = true;
// Otherwise, if the user's preference in localStorage is light...
} else if (currentTheme == "light") {
  // ...let's toggle the .light-theme class on the body
  document.body.classList.toggle("lightmode");
  // btn.checked = false;
}

// Listen for a click on the button 
btn.addEventListener("click", function(){
  // If the user's OS setting is dark and matches our .dark-mode class...
  if (prefersDarkScheme.matches) {
    // ...then toggle the light mode class
    document.body.classList.toggle("lightmode");
    // ...but use .dark-mode if the .light-mode class is already on the body,
    var theme = document.body.classList.contains("lightmode") ? "light" : "night";
  }
  else {
    // Otherwise, let's do the same thing, but for .dark-mode
    document.body.classList.toggle("nightmode");
    var theme = document.body.classList.contains("nightmode") ? "night" : "light";
  }
  // Finally, let's save the current preference to localStorage to keep using it
  localStorage.setItem("theme", theme);
});

// FORM VALIDATION
function validation(cin) {
  str = document.forms[cin].value;
  if (str.value.trim() == "") {
      alert("Enter your name");
      str.name.focus();
      return false;
  }
}
// Add Link icons automatic
// var links = document.getElementsByClassName('text-decoration-none');
// for(var i=0; i< links.length ; i++){
//   var span =  document.createElement('span');
//   span.innerHTML = '<i class="fas fa-link fa"></i>';
//   // links[i].insertBefore(,links[i]);
//   links[i].before(span);
// }