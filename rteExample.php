<?php
$editorContent = "";
$submittedContent = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['rteContent'])) {
    $editorContent = $_POST['rteContent']; // Sanitize for production
    $submittedContent = $editorContent;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rich Text Editor Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    .rte-editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 200px;
      background-color: #fff;
      overflow: auto;
    }
    .source-code {
      display: none;
      width: 100%;
      min-height: 200px;
      border: 1px solid #ccc;
      padding: 10px;
      background-color: #f9f9f9;
      font-family: monospace;
      white-space: pre-wrap;
    }
    @media (max-width: 768px) {
      .toolbar-collapse { display: none; }
      .toolbar-collapse.open { display: block; }
      .hamburger { display: inline-block; }
    }
    @media (min-width: 769px) {
      .toolbar-collapse { display: block; }
      .hamburger { display: none; }
    }
  </style>
</head>
<body class="bg-light p-4">
  <div class="container">
    <h3>Rich Text Editor Form</h3>

    <form id="rteForm" method="post" action="">
      <button type="button" class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar()">☰ Tools</button>

      <div class="rte-toolbar toolbar-collapse mb-2">
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('bold')"><b>B</b></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('italic')"><i>I</i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('underline')"><u>U</u></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('strikeThrough')"><s>S</s></button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('insertUnorderedList')">• List</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('insertOrderedList')">1. List</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('justifyLeft')">Left</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('justifyCenter')">Center</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('justifyRight')">Right</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="createLink()">Link</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('unlink')">Unlink</button>
          <button type="button" class="btn btn-outline-secondary" onclick="clearFormatting()">Clear Formatting</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-info" onclick="toggleSourceView()">Toggle Source Code</button>
        </div>
      </div>

      <!-- Rich Text Editor -->
      <div id="rteEditor" class="rte-editor" contenteditable="true"><?php echo $editorContent; ?></div>

      <!-- Source Code View -->
      <textarea id="sourceView" class="source-code" spellcheck="false"></textarea>

      <!-- Hidden Input -->
      <input type="hidden" id="rteContent" name="rteContent">

      <button type="submit" class="btn btn-success mt-3">Submit</button>
      <button type="button" class="btn btn-warning mt-3 ml-2" onclick="clearEditor()">Clear</button>
    </form>

    <?php if (!empty($submittedContent)): ?>
      <div class="mt-4">
        <h4>Output</h4>
        <div id="output" class="border p-3"><?php echo $submittedContent; ?></div>
      </div>
    <?php endif; ?>
  </div>

  <script>
    let isSourceMode = false;

    function formatText(cmd) {
      document.execCommand(cmd, false, null);
    }

    function createLink() {
      var url = prompt("Enter the URL", "https://");
      if (url) document.execCommand("createLink", false, url);
    }

    function clearFormatting() {
      const editor = document.getElementById("rteEditor");
      editor.innerHTML = editor.textContent;
    }

    function clearEditor() {
      document.getElementById("rteEditor").innerHTML = "";
      document.getElementById("sourceView").value = "";
      const output = document.getElementById("output");
      if (output) output.innerHTML = "";
    }

    function toggleToolbar() {
      document.querySelector('.toolbar-collapse').classList.toggle('open');
    }

    function toggleSourceView() {
      const editor = document.getElementById("rteEditor");
      const source = document.getElementById("sourceView");

      if (!isSourceMode) {
        source.value = editor.innerHTML.trim();
        source.style.display = "block";
        editor.style.display = "none";
        isSourceMode = true;
      } else {
        editor.innerHTML = source.value;
        editor.style.display = "block";
        source.style.display = "none";
        isSourceMode = false;
      }
    }

    // On form submit, copy from correct view to hidden input
    document.getElementById("rteForm").addEventListener("submit", function () {
      if (isSourceMode) {
        document.getElementById("rteContent").value = document.getElementById("sourceView").value;
      } else {
        document.getElementById("rteContent").value = document.getElementById("rteEditor").innerHTML;
      }
    });

    // Sync source textarea on load (in case content already exists)
    window.addEventListener("DOMContentLoaded", function () {
      const editor = document.getElementById("rteEditor");
      const source = document.getElementById("sourceView");
      source.value = editor.innerHTML.trim();
    });
  </script>
</body>
</html>


