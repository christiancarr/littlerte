<?php
$editorContent = "";
$submittedContent = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['rteContent'])) {
    // In a production app, be sure to sanitize this output.
    $editorContent = $_POST['rteContent'];
    $submittedContent = $editorContent;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Standalone RTE Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    .rte-editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 200px;
      overflow: auto;
      background-color: #fff;
    }
    .source-code {
      display: none;
      white-space: pre-wrap;
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 200px;
      background-color: #f9f9f9;
    }
    /* Mobile styles */
    @media (max-width: 768px) {
      .toolbar-collapse {
        display: none;
      }
      /* When .open is added, show the toolbar */
      .toolbar-collapse.open {
        display: block;
      }
      .hamburger {
        display: inline-block;
      }
    }
    /* Desktop styles */
    @media (min-width: 769px) {
      .toolbar-collapse {
        display: block;
      }
      .hamburger {
        display: none;
      }
    }
  </style>
</head>
<body class="bg-light p-4">
  <div class="container">
    <h3>Rich Text Editor Form</h3>
    <!-- Form submits to itself -->
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

      <!-- Rich text editor starts with content if previously submitted -->
      <div id="rteEditor" class="rte-editor" contenteditable="true"><?php echo $editorContent; ?></div>
      <!-- Hidden input to capture the editor's HTML content -->
      <input type="hidden" id="rteContent" name="rteContent">
      
      <!-- Green submit button and clear button -->
      <button type="submit" class="btn btn-success mt-2">Submit</button>
      <button type="button" class="btn btn-warning mt-2 ml-2" onclick="clearEditor()">Clear</button>
    </form>

    <!-- Output section to display submitted content -->
    <?php if (!empty($submittedContent)): ?>
      <div class="mt-4">
        <h4>Output</h4>
        <div id="output" class="border p-3">
          <?php echo $submittedContent; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <script>
    function formatText(command) {
      document.execCommand(command, false, null);
    }
    function createLink() {
      var url = prompt("Enter the URL", "https://");
      if (url) document.execCommand("createLink", false, url);
    }
    // This clears formatting but preserves text content.
    function clearFormatting() {
      let editor = document.getElementById("rteEditor");
      editor.innerHTML = editor.textContent;
    }
    // Clears all content in the editor and the output area.
    function clearEditor() {
      document.getElementById("rteEditor").innerHTML = "";
      var output = document.getElementById("output");
      if (output) {
        output.innerHTML = "";
      }
    }
    // Toggle the toolbar display.
    function toggleToolbar() {
      document.querySelector('.toolbar-collapse').classList.toggle('open');
    }
    // On window resize, ensure the toolbar is visible on desktop.
    window.addEventListener('resize', function() {
      var toolbar = document.querySelector('.toolbar-collapse');
      if (window.innerWidth >= 769) {
        toolbar.classList.remove('open');
      }
    });
    function toggleSourceView() {
      var editor = document.getElementById("rteEditor");
      var source = document.getElementById("sourceView");
      if (source.style.display === "none" || source.style.display === "") {
        source.textContent = editor.innerHTML;
        source.style.display = "block";
        editor.style.display = "none";
      } else {
        editor.innerHTML = source.textContent;
        source.style.display = "none";
        editor.style.display = "block";
      }
    }
    // Before the form submits, copy the RTE content into the hidden input.
    document.getElementById('rteForm').addEventListener('submit', function() {
      document.getElementById('rteContent').value = document.getElementById('rteEditor').innerHTML;
    });
  </script>
</body>
</html>

