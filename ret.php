<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Standalone RTE</title>
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
    <h3>Rich Text Editor</h3>
    <button class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar()">☰ Tools</button>
    <div class="rte-toolbar toolbar-collapse mb-2">
      <div class="btn-group mb-2">
        <button class="btn btn-outline-secondary" onclick="formatText('bold')"><b>B</b></button>
        <button class="btn btn-outline-secondary" onclick="formatText('italic')"><i>I</i></button>
        <button class="btn btn-outline-secondary" onclick="formatText('underline')"><u>U</u></button>
        <button class="btn btn-outline-secondary" onclick="formatText('strikeThrough')"><s>S</s></button>
      </div>
      <div class="btn-group mb-2">
        <button class="btn btn-outline-secondary" onclick="formatText('insertUnorderedList')">• List</button>
        <button class="btn btn-outline-secondary" onclick="formatText('insertOrderedList')">1. List</button>
      </div>
      <div class="btn-group mb-2">
        <button class="btn btn-outline-secondary" onclick="formatText('justifyLeft')">Left</button>
        <button class="btn btn-outline-secondary" onclick="formatText('justifyCenter')">Center</button>
        <button class="btn btn-outline-secondary" onclick="formatText('justifyRight')">Right</button>
      </div>
      <div class="btn-group mb-2">
        <button class="btn btn-outline-secondary" onclick="createLink()">Link</button>
        <button class="btn btn-outline-secondary" onclick="formatText('unlink')">Unlink</button>
        <button class="btn btn-outline-secondary" onclick="clearFormatting()">Clear</button>
      </div>
      <div class="btn-group mb-2">
        <button class="btn btn-outline-info" onclick="toggleSourceView()">Toggle Source Code</button>
      </div>
    </div>

    <div id="rteEditor" class="rte-editor" contenteditable="true">
      <p>Start writing here...</p>
    </div>
    <div id="sourceView" class="source-code"></div>
  </div>

  <script>
    function formatText(command) {
      document.execCommand(command, false, null);
    }
    function createLink() {
      var url = prompt("Enter the URL", "https://");
      if (url) document.execCommand("createLink", false, url);
    }
    function clearFormatting() {
      let editor = document.getElementById("rteEditor");
      editor.innerHTML = editor.textContent;
    }
    // Toggle the toolbar using the custom "open" class.
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
  </script>
</body>
</html>
