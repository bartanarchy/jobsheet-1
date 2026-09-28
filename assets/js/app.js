// ===== Hamburger menu =====
function initNavToggle() {
  const toggleBtn = document.getElementById("nav-toggle-btn");
  const nav = document.querySelector("header nav");
  if (!toggleBtn || !nav) return;

  toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
  });
}

// ===== Delete confirmation =====
// The Delete button lives inside a real <form method="post"> in a table cell.
// We listen to the form's "submit" event (not the button's "click") so the
// request can be cancelled with preventDefault() BEFORE it is sent.
// Any form inside a <td> is treated as a row-level delete form, so this does
// not depend on a specific class name.
function initDeleteConfirm() {
  document.addEventListener("submit", function (e) {
    const form = e.target;
    if (!form.closest("td")) return;

    const row = form.closest("tr");
    const firstCell = row ? row.querySelector("td") : null;
    const name = firstCell ? firstCell.textContent.trim() : "this item";

    const confirmed = confirm('Are you sure you want to delete "' + name + '"?');
    if (!confirmed) {
      e.preventDefault();
    }
  });
}

// ===== Instant client-side table filter =====
function initTableFilter() {
  const input = document.getElementById("search-input");
  const table = document.querySelector(".table-responsive table");
  if (!input || !table) return;

  input.addEventListener("keyup", function () {
    const keyword = input.value.toLowerCase();
    table.querySelectorAll("tbody tr").forEach(function (row) {
      row.style.display = row.textContent.toLowerCase().includes(keyword) ? "" : "none";
    });
  });
}

// ===== Client-side form validation (Add / Edit pages) =====
function showError(input, message) {
  clearError(input);
  const span = document.createElement("span");
  span.className = "error";
  span.textContent = message;
  input.insertAdjacentElement("afterend", span);
}

function clearError(input) {
  const next = input.nextElementSibling;
  if (next && next.classList.contains("error")) {
    next.remove();
  }
}

function requireField(form, selector, message) {
  const input = form.querySelector(selector);
  if (!input) return true;
  if (input.value.trim() === "") {
    showError(input, message);
    return false;
  }
  clearError(input);
  return true;
}

function initFormValidation() {
  // Page-level form only: a form that is a direct child of <section> or <main>.
  // (Search forms and row-level delete forms are nested deeper, so they are skipped.)
  const form = document.querySelector("main section > form, main > form");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    let valid = true;

    valid = requireField(form, "[name='title'], [name='name']", "This field is required.") && valid;
    valid = requireField(form, "[name='author']", "This field is required.") && valid;
    valid = requireField(form, "[name='member_no']", "This field is required.") && valid;

    const year = form.querySelector("[name='year']");
    if (year) {
      const value = parseInt(year.value, 10);
      if (isNaN(value) || value < 1900 || value > 2026) {
        showError(year, "Year must be between 1900-2026.");
        valid = false;
      } else {
        clearError(year);
      }
    }

    const stock = form.querySelector("[name='stock']");
    if (stock) {
      const value = parseInt(stock.value, 10);
      if (isNaN(value) || value < 0) {
        showError(stock, "Stock cannot be negative.");
        valid = false;
      } else {
        clearError(stock);
      }
    }

    if (!valid) {
      e.preventDefault();
    }
  });
}

// ===== Entry point =====
document.addEventListener("DOMContentLoaded", function () {
  initNavToggle();
  initDeleteConfirm();
  initTableFilter();
  initFormValidation();
});