// Fetches & displays the Book List asynchronously from data/buku.json
async function loadBookList() {
  const tbody = document.querySelector(".table-responsive table tbody");
  const loading = document.getElementById("loading-indicator");
  if (!tbody) return;

  loading.style.display = "block";
  tbody.innerHTML = "";

  try {
    // Simulated network delay so the loading indicator is visible
    await new Promise((resolve) => setTimeout(resolve, 600));

    const res = await fetch("../data/buku.json");
    if (!res.ok) {
      throw new Error("Failed to fetch data (status " + res.status + ")");
    }

    const bookList = await res.json();

    bookList.forEach(function (book) {
      const tr = document.createElement("tr");
      tr.innerHTML =
        "<td>" + book.title + "</td>" +
        "<td>" + book.author + "</td>" +
        "<td>" + book.year + "</td>" +
        "<td>" + book.stock + "</td>" +
        "<td>" + book.category + "</td>" +
        "<td>" +
        '<button type="button">Edit</button> ' +
        '<button type="button">Detail</button> ' +
        '<button type="button" class="btn-delete">Delete</button>' +
        "</td>";
      tbody.appendChild(tr);
    });
  } catch (err) {
    tbody.innerHTML =
      '<tr><td colspan="6">Failed to load data: ' + err.message + "</td></tr>";
  } finally {
    loading.style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  loadBookList();
  const btnReload = document.getElementById("btn-reload");
  if (btnReload) btnReload.addEventListener("click", loadBookList);
});