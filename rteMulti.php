<?php
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
  <title>Multiple Rich Text Editors</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    .rte-editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 150px;
      background-color: #fff;
      overflow: auto;
    }
    .source-code {
      display: none;
      width: 100%;
      min-height: 150px;
      border: 1px solid #ccc;
      padding: 10px;
      background-color: #f9f9f9;
      font-family: monospace;
      white-space: pre-wrap;
      margin-top: 10px;
    }
    .rte-toolbar {
      margin-bottom: 10px;
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
  <h3>Multiple Rich Text Editors</h3>
  <form id="rteForm" method="post" action="">

    <!-- RTE FIELD 1 -->
    <div class="mb-4">
      <h5>Rich Text Editor 1</h5>
      <button type="button" class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar('toolbar1')">☰ Tools</button>
      <div id="toolbar1" class="rte-toolbar toolbar-collapse mb-2">
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'bold')"><b>B</b></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'italic')"><i>I</i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'underline')"><u>U</u></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'strikeThrough')"><s>S</s></button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'insertUnorderedList')">• List</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'insertOrderedList')">1. List</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'justifyLeft')">Left</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'justifyCenter')">Center</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'justifyRight')">Right</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="createLink('rteEditor1')">Link</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor1', 'unlink')">Unlink</button>
          <button type="button" class="btn btn-outline-secondary" onclick="clearFormatting('rteEditor1')">Clear</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-info" onclick="toggleSourceView('rteEditor1', 'source1')">Toggle Source Code</button>
        </div>
      </div>
      <div id="rteEditor1" class="rte-editor" contenteditable="true"><?php echo $editorContent1; ?></div>
      <textarea id="source1" class="source-code"></textarea>
      <input type="hidden" name="rteContent1" id="rteContent1">
    </div>

    <!-- RTE FIELD 2 -->
    <div class="mb-4">
      <h5>Rich Text Editor 2</h5>
      <button type="button" class="btn btn-outline-secondary hamburger mb-2" onclick="toggleToolbar('toolbar2')">☰ Tools</button>
      <div id="toolbar2" class="rte-toolbar toolbar-collapse mb-2">
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'bold')"><b>B</b></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'italic')"><i>I</i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'underline')"><u>U</u></button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'strikeThrough')"><s>S</s></button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'insertUnorderedList')">• List</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'insertOrderedList')">1. List</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'justifyLeft')">Left</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'justifyCenter')">Center</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'justifyRight')">Right</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-secondary" onclick="createLink('rteEditor2')">Link</button>
          <button type="button" class="btn btn-outline-secondary" onclick="formatText('rteEditor2', 'unlink')">Unlink</button>
          <button type="button" class="btn btn-outline-secondary" onclick="clearFormatting('rteEditor2')">Clear</button>
        </div>
        <div class="btn-group mb-2">
          <button type="button" class="btn btn-outline-info" onclick="toggleSourceView('rteEditor2', 'source2')">Toggle Source Code</button>
        </div>
      </div>
      <div id="rteEditor2" class="rte-editor" contenteditable="true"><?php echo $editorContent2; ?></div>
      <textarea id="source2" class="source-code"></textarea>
      <input type="hidden" name="rteContent2" id="rteContent2">
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
    <button type="button" class="btn btn-warning ml-2" onclick="clearAll()">Clear</button>
  </form>

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
  const sourceStates = {
    rteEditor1: false,
    rteEditor2: false
  };

  function formatText(editorId, command) {
    const editor = document.getElementById(editorId);
    editor.focus();
    document.execCommand(command, false, null);
  }

  function createLink(editorId) {
    const editor = document.getElementById(editorId);
    editor.focus();
    const url = prompt("Enter the URL", "https://");
    if (url) {
      document.execCommand("createLink", false, url);
    }
  }

  function clearFormatting(editorId) {
    const editor = document.getElementById(editorId);
    editor.innerHTML = editor.textContent;
  }

  function toggleToolbar(toolbarId) {
    document.getElementById(toolbarId).classList.toggle('open');
  }

  function toggleSourceView(editorId, sourceId) {
    const editor = document.getElementById(editorId);
    const source = document.getElementById(sourceId);
    const isSource = sourceStates[editorId];

    if (!isSource) {
      source.value = editor.innerHTML;
      editor.style.display = "none";
      source.style.display = "block";
      sourceStates[editorId] = true;
    } else {
      editor.innerHTML = source.value;
      source.style.display = "none";
      editor.style.display = "block";
      sourceStates[editorId] = false;
    }
  }

  document.getElementById("rteForm").addEventListener("submit", function () {
    const isSource1 = sourceStates['rteEditor1'];
    const isSource2 = sourceStates['rteEditor2'];

    document.getElementById("rteContent1").value = isSource1 ? document.getElementById("source1").value : document.getElementById("rteEditor1").innerHTML;
    document.getElementById("rteContent2").value = isSource2 ? document.getElementById("source2").value : document.getElementById("rteEditor2").innerHTML;
  });

  function clearAll() {
    document.getElementById("rteEditor1").innerHTML = "";
    document.getElementById("rteEditor2").innerHTML = "";
    document.getElementById("source1").value = "";
    document.getElementById("source2").value = "";
    const out1 = document.getElementById("output1");
    const out2 = document.getElementById("output2");
    if (out1) out1.innerHTML = "";
    if (out2) out2.innerHTML = "";
  }
</script>
</body>
</html>

