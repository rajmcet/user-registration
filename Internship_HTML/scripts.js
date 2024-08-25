function addSubject() {
  const subjectsDiv = document.getElementById("subjects");
  const subjectDiv = document.createElement("div");
  subjectDiv.className = "subject";

  subjectDiv.innerHTML = `
        <label>Subject ${subjectsDiv.children.length + 1}:</label>
        <input type="number" name="gradePoints[]" step="0.01" placeholder="Grade Points" required>
        <input type="number" name="creditHours[]" step="0.01" placeholder="Credit Hours" required>
    `;

  subjectsDiv.appendChild(subjectDiv);
}
