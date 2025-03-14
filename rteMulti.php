<?php
// Initialize content variables.
$editorContent1 = "";
$editorContent2 = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['rteContent1'])) {
        $editorContent1 = $_POST['rteContent1'];
    }
    if (isset($_POST['rteContent2'])) {
        $editorContent2 = $_POST['rteContent2'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Multiple Rich Text Editor Fields</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    .rte-editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 150px;
      overflow: auto;
      background-color: #fff;
      margin-bottom: 10px;
    }
    .rte-toolbar {
      margin-bottom: 5px;
    }
    .source-code {
      display: none;
      white-space: pre-wrap;
      border: 1px solid #ccc;
      padding: 10px;
      background-color: #f9f9f9;
    }
    /* Mobile styles */
    @media (max-width: 768px) {
      .toolbar-collapse {
        display: none;
      }
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
  <h3>Multiple Rich Text Editor Fields</h3>
  <form id="rteForm" method="post" action="">
    
    <!-- RTE Field 1 -->
    <div class="mb-4">
      <h5>Rich Text Editor Field 1</h5>
      <button type="button" class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar('toolbar1')">☰ Tools</button>
      <div id="toolbar1" class="rte-toolbar toolbar-collapse mb-2">
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'bold')"><b>B</b></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'italic')"><i>I</i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'underline')"><u>U</u></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'strikeThrough')"><s>S</s></button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'insertUnorderedList')">• List</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'insertOrderedList')">1. List</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'justifyLeft')">Left</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'justifyCenter')">Center</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'justifyRight')">Right</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="createLinkField('rteEditor1')">Link</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor1', 'unlink')">Unlink</button>
          <button type="button" class="btn btn-outline-secondary" onclick="clearFormattingField('rteEditor1')">Clear Formatting</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-info" onclick="toggleSourceViewField('rteEditor1', 'source1')">Toggle Source Code</button>
        </div>
      </div>
      <div id="rteEditor1" class="rte-editor" contenteditable="true"><?php echo $editorContent1; ?></div>
      <div id="source1" class="source-code"></div>
      <input type="hidden" id="rteContent1" name="rteContent1">
    </div>
    
    <!-- RTE Field 2 -->
    <div class="mb-4">
      <h5>Rich Text Editor Field 2</h5>
      <button type="button" class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar('toolbar2')">☰ Tools</button>
      <div id="toolbar2" class="rte-toolbar toolbar-collapse mb-2">
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'bold')"><b>B</b></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'italic')"><i>I</i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'underline')"><u>U</u></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'strikeThrough')"><s>S</s></button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'insertUnorderedList')">• List</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'insertOrderedList')">1. List</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'justifyLeft')">Left</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'justifyCenter')">Center</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'justifyRight')">Right</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="createLinkField('rteEditor2')">Link</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatTextField('rteEditor2', 'unlink')">Unlink</button>
          <button type="button" class="btn btn-outline-secondary" onclick="clearFormattingField('rteEditor2')">Clear Formatting</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-info" onclick="toggleSourceViewField('rteEditor2', 'source2')">Toggle Source Code</button>
        </div>
      </div>
      <div id="rteEditor2" class="rte-editor" contenteditable="true"><?php echo $editorContent2; ?></div>
      <div id="source2" class="source-code"></div>
      <input type="hidden" id="rteContent2" name="rteContent2">
    </div>
    
    <!-- Submit and Clear Buttons -->
    <button type="submit" class="btn btn-success mt-2">Submit</button>
    <button type="button" class="btn btn-warning mt-2 ml-2" onclick="clearAllEditors()">Clear</button>
  </form>
  
  <!-- Output Sections -->
  <?php if (!empty($editorContent1) || !empty($editorContent2)): ?>
  <div class="mt-4">
    <h4>Output</h4>
    <div class="border p-3 mb-3">
      <h5>Output 1</h5>
      <div id="output1"><?php echo $editorContent1; ?></div>
    </div>
    <div class="border p-3">
      <h5>Output 2</h5>
      <div id="output2"><?php echo $editorContent2; ?></div>
    </div>
  </div>
  <?php endif; ?>
</div>

<script>
  // Apply formatting to a specified editor.
  function formatTextField(editorId, command) {
    var editor = document.getElementById(editorId);
    editor.focus();
    document.execCommand(command, false, null);
  }
  // Prompt for a link and apply it to the specified editor.
  function createLinkField(editorId) {
    var url = prompt("Enter the URL", "https://");
    if (url) {
      var editor = document.getElementById(editorId);
      editor.focus();
      document.execCommand("createLink", false, url);
    }
  }
  // Clear formatting by replacing innerHTML with textContent.
  function clearFormattingField(editorId) {
    var editor = document.getElementById(editorId);
    editor.innerHTML = editor.textContent;
  }
  // Toggle toolbar display by ID.
  function toggleToolbar(toolbarId) {
    document.getElementById(toolbarId).classList.toggle('open');
  }
  // Toggle source view for a specific editor.
  function toggleSourceViewField(editorId, sourceId) {
    var editor = document.getElementById(editorId);
    var source = document.getElementById(sourceId);
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
  // Clear both editors and their corresponding output sections.
  function clearAllEditors() {
    document.getElementById("rteEditor1").innerHTML = "";
    document.getElementById("rteEditor2").innerHTML = "";
    var output1 = document.getElementById("output1");
    var output2 = document.getElementById("output2");
    if (output1) output1.innerHTML = "";
    if (output2) output2.innerHTML = "";
  }
  // Before form submission, copy each editor's HTML into its hidden input.
  document.getElementById('rteForm').addEventListener('submit', function() {
    document.getElementById('rteContent1').value = document.getElementById('rteEditor1').innerHTML;
    document.getElementById('rteContent2').value = document.getElementById('rteEditor2').innerHTML;
  });
  
  // On window resize, ensure toolbars are visible on desktop.
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 769) {
      document.getElementById('toolbar1').classList.remove('open');
      document.getElementById('toolbar2').classList.remove('open');
    }
  });
</script>
</body>
</html>
