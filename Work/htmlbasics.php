<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }
        .arrow{
  position:relative;
  width:30px;
  height: 30px;
  cursor:pointer;
/*   border:solid 1px white; */
  transition:0.5s;
  overflow:hidden;
}

.arrow:hover{
/*  animation:borderAni 5s cubic-bezier(0, 0.6, 1, 0.4); */
      border:solid 2px white; 
    border-radius:50%;
}
.arrow:after{
  position:absolute;
  display:block;
  content:"";
  color:white;
  width: 20px;
  height: 15px;
/*   border:solid 1px;  */
  top:-1px;
  border-bottom:solid 2px;
  transform:translatex(4px);
}

.arrow:before{
  position:absolute;
  display:block;
  content:"";
  color:white;
  width: 8px;
  height: 8px;
/*   border:solid 1px;  */
  border-top:solid 2px;
  border-left:solid 2px;
  top:50%;
  left:2px;
  transform-origin:0% 0%;
  transform:rotatez(-45deg);

}
.arrow:hover:before{
 animation: aniArrow01 1s cubic-bezier(0, 0.6, 1, 0.4) infinite 0.5s;
}

.arrow:hover:after{
 animation: aniArrow02 1s cubic-bezier(0, 0.6, 1, 0.4) infinite 0.5s;
}


@keyframes aniArrow01 {
  0% {
    transform:rotatez(-45deg) translateY(30px) translateX(30px);
  }
  100% {
    transform: rotatez(-45deg) translateY(-35px) translateX(-35px);
  }
}


@keyframes aniArrow02 {
  0% {
    transform:translateX(45px);
  }
  100% {
    transform:translateX(-44px);
  }
}

@keyframes borderAni{
   0% {
    border:solid 2px white;
  }
  100% {    
    border:solid 2px white; 
    border-radius:50%;
  }
}
    </style>
</head>
<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>