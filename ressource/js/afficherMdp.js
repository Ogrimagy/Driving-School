var eye = 0;

function afficherLettre() {
    var x = document.getElementById("input2");
    if (x.type === "password") {
       x.type = "text";
    } else {
        x.type = "password";
    }
    var z = document.getElementById("eyeIcon");
    if (eye == 0) {
		z.className = "las la-eye unselectable";
		eye = 1;
    }
    else{
        z.className = "las la-eye-slash unselectable";
        eye = 0
    }
}