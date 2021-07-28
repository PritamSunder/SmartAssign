<!DOCTYPE html>
<html>
 <head>
   <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
   <link rel="manifest" href="images/site.webmanifest">
  <title>Teacher's Portal</title>
  <style>
  @import url("https://fonts.googleapis.com/css?family=Hind+Madurai:300,600|Poppins:300&display=swap");

  :root {
      --yellow: #ffd049;
      --light-yellow: #fdf2d2;
      --orange: #ffa929;
      --light-gray: #e3e4e8;
      --gray: #71738b;
      --light-blue: #7a7c93;
      --blue: #34385a;

      --slider-handle-size: 14px;
      --slider-handle-border-radius: 2px;
      --slider-handle-margin-top: -4px;
      --slider-track-height: 6px;
      --slider-track-border-radius: 4px;
  }

  * {
      box-sizing: border-box;
  }

  body {
      margin: 0 auto;
  }

  #wrapper {
      position: absolute;
      width: 100%;
      height: 100%;

      display: flex;
      justify-content: center;
      align-items: center;
  }

  #sliderContainer {
      width: 100%;
      max-width: 440px;

      padding: 56px 40px;

      border-radius: 40px;

      box-shadow: 0px 8px 40px rgba(128, 128, 128, 0.15);
  }

  #sliderContainer>div:first-child {
      margin-bottom: 48px;
  }

  .tick-slider-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 24px;
  }

  .tick-slider-header>h5 {
      margin: 0;

      font-family: "Poppins", sans-serif;
      font-size: 18px;
      font-weight: 300;
      color: var(--gray);
  }

  .tick-slider {
      position: relative;

      width: 100%;
  }

  .tick-slider-value-container {
      position: relative;
      width: 100%;

      display: flex;
      justify-content: space-between;
      align-items: center;

      margin-bottom: 12px;

      font-family: "Hind Madurai", sans-serif;
      font-size: 18px;
      color: var(--gray);
  }

  .tick-slider-value {
      position: absolute;
      top: 0;

      font-weight: bold;

      color: var(--blue);

      border-radius: var(--slider-handle-border-radius);
  }

  .tick-slider-value>div {
      animation: bulge 0.3s ease-out;
  }

  .tick-slider-background,
  .tick-slider-progress,
  .tick-slider-tick-container {
      position: absolute;
      bottom: 5px;
      left: 0;

      height: var(--slider-track-height);

      pointer-events: none;

      border-radius: var(--slider-track-border-radius);

      z-index: -1;
  }

  .tick-slider-background {
      width: 100%;
      background-color: var(--light-gray);
  }

  .tick-slider-progress {
      background-color: var(--light-blue);
  }

  .tick-slider-tick-container {
      width: 100%;

      display: flex;
      justify-content: space-between;
      align-items: center;

      padding: 0 calc(var(--slider-handle-size) / 2);
  }

  .tick-slider-tick {
      width: 2px;
      height: 2px;

      border-radius: 50%;

      background-color: white;
  }

  .tick-slider-label {
      opacity: 0.85;
      transition: opacity 0.1s ease;
  }

  .tick-slider-label.hidden {
      opacity: 0;
  }

  @keyframes bulge {
      0% {
          transform: scale(1);
      }

      25% {
          transform: scale(1.1);
      }

      100% {
          transform: scale(1);
      }
  }

  /*

      REMOVE SLIDER STYLE DEFAULTS

  */
  input[type="range"] {
      -webkit-appearance: none;

      width: 100%;
      height: 100%;

      background: transparent;
      outline: none;

      margin: 5px 0;
  }

  input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;

      border: none;
  }

  input[type="range"]:focus {
      outline: none;
  }

  input[type="range"]::-moz-focus-outer {
      border: 0;
  }

  /*

      HANDLE

  */
  input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;

      width: var(--slider-handle-size);
      height: var(--slider-handle-size);

      background: var(--blue);

      border-radius: var(--slider-handle-border-radius);

      cursor: pointer;

      margin-top: var(--slider-handle-margin-top);

      -webkit-transform: scale(1);
      transform: scale(1);

      transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  input[type="range"]:hover::-webkit-slider-thumb,
  input[type="range"]:focus::-webkit-slider-thumb {
      transform: scale(1.2);
  }

  input[type="range"]::-moz-range-thumb {
      -webkit-appearance: none;

      width: var(--slider-handle-size);
      height: var(--slider-handle-size);

      background: var(--orange);

      border: none;
      border-radius: var(--slider-handle-border-radius);

      cursor: pointer;

      transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  input[type="range"]:hover::-moz-range-thumb,
  input[type="range"]:focus::-moz-range-thumb {
      transform: scale(1.2);
  }

  /*

      TRACK

  */

  input[type="range"]::-webkit-slider-runnable-track {
      width: 100%;
      height: var(--slider-track-height);

      cursor: pointer;

      background: none;

      border-radius: var(--slider-track-border-radius);
  }

  input[type="range"]::-moz-range-track {
      width: 100%;
      height: var(--slider-track-height);

      cursor: pointer;

      background: none;

      border-radius: var(--slider-track-border-radius);
  }

  input[type="range"]:focus::-webkit-slider-runnable-track {
      background: none;
  }
  input[type="range"]:active::-webkit-slider-runnable-track {
      background: none;
  }
  button {
    cursor: pointer;
    margin:0 auto;
    display:block;
    padding: 8px 15px;
    background-color: var(--blue);
    color: white;
    border-radius: 20px;

}
.remarks{
  border:0;
  outline: none;
  border-bottom: 1px solid var(--light-blue);
  width: 100%;
  height:40px;
  font-family: "Poppins", sans-serif;
  font-size: 18px;
  font-weight: 300;
  color: var(--gray);

}
a{
  text-decoration: none;
  font-family: "Poppins", sans-serif;
  font-size: 18px;
  font-weight: 300;
}
.filesub{
  margin: 0;
  margin-right: 20px;
  font-family: "Poppins", sans-serif;
  font-size: 18px;
  font-weight: 300;
  color: var(--gray);
}
</style>
</head>
<body>

<?php
$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$id = isset($_GET['id'])?$_GET['id'] : "";
$stati = $dbh-> prepare("select * from storage where id = ?");
$stati->bindParam(1,$id);
$stati->execute();
$row = $stati->fetch();
?>
<div id="wrapper">
    <div id="sliderContainer">
      <?php
        echo "<label class= 'filesub'>File Submitted:</label><a target='_blank' href='scripts/assignment.php?id=".$id."'>".$row['name']."</a><br><br>";
      ?>
      <form action="" method="post" autocomplete="off">
        <div class="tick-slider">
            <div class="tick-slider-header">
                <h5><label for="sizeSlider">Grade</label></h5>
                <h5>Out of 10</h5>
            </div>
            <div class="tick-slider-value-container">
                <div id="sizeLabelMin" class="tick-slider-label">0</div>
                <div id="sizeLabelMax" class="tick-slider-label">10</div>
                <div id="sizeValue" class="tick-slider-value"></div>
            </div>
            <div class="tick-slider-background"></div>
            <div id="sizeProgress" class="tick-slider-progress"></div>
            <div id="sizeTicks" class="tick-slider-tick-container"></div>
            <input
                id="sizeSlider"
                name="marks"
                class="tick-slider-input"
                type="range"
                min="0"
                max="10"
                step="1"
                value="5"
                data-tick-step="1"
                data-tick-id="sizeTicks"
                data-value-id="sizeValue"
                data-progress-id="sizeProgress"
                data-handle-size="18"
                data-min-label-id="sizeLabelMin"
                data-max-label-id="sizeLabelMax"
            />
        </div>
        <br><br>
        <input type="text" class="remarks" name="remarks" placeholder="Remarks"><br><br><br><br>
        <button name='btn'>Submit</button>
      </form>
    </div>
</div>
<?php

if(isset($_POST['marks'])){
    $grade = $_POST['marks'];
}
if(isset($_POST['marks'])){
    $remark = $_POST['remarks'];
}
else{
  $remark = " ";
}
if (isset($_POST['btn'])){
  $stati = $dbh-> prepare("insert into grades values (?,?,?)");
  $stati->bindParam(1,$id);
  $stati->bindParam(2,$grade);
  $stati->bindParam(3,$remark);
  $stati->execute();

echo "<script>window.location.href='tui.php'</script>";
}

 ?>
</body>
</html>
<script>
function init() {
    const sliders = document.getElementsByClassName("tick-slider-input");

    for (let slider of sliders) {
        slider.oninput = onSliderInput;

        updateValue(slider);
        updateValuePosition(slider);
        updateLabels(slider);
        updateProgress(slider);

        setTicks(slider);
    }
}

function onSliderInput(event) {
    updateValue(event.target);
    updateValuePosition(event.target);
    updateLabels(event.target);
    updateProgress(event.target);
}

function updateValue(slider) {
    let value = document.getElementById(slider.dataset.valueId);

    value.innerHTML = "<div>" + slider.value + "</div>";
}

function updateValuePosition(slider) {
    let value = document.getElementById(slider.dataset.valueId);

    const percent = getSliderPercent(slider);

    const sliderWidth = slider.getBoundingClientRect().width;
    const valueWidth = value.getBoundingClientRect().width;
    const handleSize = slider.dataset.handleSize;

    let left = percent * (sliderWidth - handleSize) + handleSize / 2 - valueWidth / 2;

    left = Math.min(left, sliderWidth - valueWidth);
    left = slider.value === slider.min ? 0 : left;

    value.style.left = left + "px";
}

function updateLabels(slider) {
    const value = document.getElementById(slider.dataset.valueId);
    const minLabel = document.getElementById(slider.dataset.minLabelId);
    const maxLabel = document.getElementById(slider.dataset.maxLabelId);

    const valueRect = value.getBoundingClientRect();
    const minLabelRect = minLabel.getBoundingClientRect();
    const maxLabelRect = maxLabel.getBoundingClientRect();

    const minLabelDelta = valueRect.left - (minLabelRect.left);
    const maxLabelDelta = maxLabelRect.left - valueRect.left;

    const deltaThreshold = 32;

    if (minLabelDelta < deltaThreshold) minLabel.classList.add("hidden");
    else minLabel.classList.remove("hidden");

    if (maxLabelDelta < deltaThreshold) maxLabel.classList.add("hidden");
    else maxLabel.classList.remove("hidden");
}

function updateProgress(slider) {
    let progress = document.getElementById(slider.dataset.progressId);
    const percent = getSliderPercent(slider);

    progress.style.width = percent * 100 + "%";
}

function getSliderPercent(slider) {
    const range = slider.max - slider.min;
    const absValue = slider.value - slider.min;

    return absValue / range;
}

function setTicks(slider) {
    let container = document.getElementById(slider.dataset.tickId);
    const spacing = parseFloat(slider.dataset.tickStep);
    const sliderRange = slider.max - slider.min;
    const tickCount = sliderRange / spacing + 1; // +1 to account for 0

    for (let ii = 0; ii < tickCount; ii++) {
        let tick = document.createElement("span");

        tick.className = "tick-slider-tick";

        container.appendChild(tick);
    }
}

function onResize() {
    const sliders = document.getElementsByClassName("tick-slider-input");

    for (let slider of sliders) {
        updateValuePosition(slider);
    }
}


window.onload = init;
window.addEventListener("resize", onResize);

</script>
