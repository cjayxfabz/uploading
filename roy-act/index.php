<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background-color: #f4f4f9;
}

h2 {
  text-align: center;
  color: #333;
  padding: 20px;
  font-weight: bold;
}

.row > .column {
  padding: 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
  padding: 8px;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.8);
}

.modal-content {
  position: relative;
  background-color: #fff;
  margin: auto;
  padding: 20px;
  width: 80%;
  max-width: 900px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
  color: #aaa;
  position: absolute;
  top: 15px;
  right: 25px;
  font-size: 30px;
  font-weight: bold;
  transition: color 0.3s ease;
}

.close:hover,
.close:focus {
  color: #333;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 12px;
  color: #333;
  font-weight: bold;
  font-size: 18px;
  transition: background-color 0.3s;
  border-radius: 3px;
  user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev:hover,
.next:hover {
  background-color: rgba(255, 255, 255, 0.6);
}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
  border-radius: 4px;
}

.caption-container {
  text-align: center;
  padding: 10px;
  background-color: #222;
  color: #f4f4f9;
  border-radius: 0 0 8px 8px;
}

.demo {
  opacity: 0.7;
  transition: opacity 0.3s ease;
  border-radius: 4px;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 4px;
}

.hover-shadow:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}
</style>

</style>
<body>

<h2 style="text-align:center">Fabrigas Gallery</h2>

<div class="row">
  <?php
  $directory = 'upload/';

  if (is_dir($directory)) {
      $files = scandir($directory);
      

      $counter = 1;
      
      foreach ($files as $file) {
          if ($file !== '.' && $file !== '..' && is_file($directory . $file)) {
              $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
              // Display the image only if it's a valid image type (jpg, jpeg, png, gif)
              if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                  echo '<div class="column">';
                  echo '<img src="' . $directory . $file . '" style="width:100%" onclick="openModal();currentSlide(' . $counter . ')" class="hover-shadow cursor" alt="' . htmlspecialchars($file) . '">';
                  echo '</div>';
                  $counter++;
              }
          }
      }
  } else {
      echo 'Directory not found or not readable.';
  }
  ?>
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    
    <?php

    $counter = 1;


    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && is_file($directory . $file)) {
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo '<div class="mySlides">';
                echo '<div class="numbertext">' . $counter . ' / ' . (count($files) - 2) . '</div>'; // Adjust count for . and ..
                echo '<img src="' . $directory . $file . '" style="width:100%">';
                echo '</div>';
                $counter++;
            }
        }
    }
    ?>
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="row">
      <?php
      $counter = 1;
      foreach ($files as $file) {
          if ($file !== '.' && $file !== '..' && is_file($directory . $file)) {
              $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
              if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                  echo '<div class="column">';
                  echo '<img class="demo cursor" src="' . $directory . $file . '" style="width:100%" onclick="currentSlide(' . $counter . ')" alt="' . htmlspecialchars($file) . '">';
                  echo '</div>';
                  $counter++;
              }
          }
      }
      ?>
    </div>
  </div>
</div>

<script>

function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

</body>
</html>
