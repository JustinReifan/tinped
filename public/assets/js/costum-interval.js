function exp(deadline) {
    document.getElementById("exp").innerHTML = "Retrieving Data...";
    var deadline = new Date(deadline).getTime();
    var x = setInterval(function () {
        var now = new Date().getTime();
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        var filtertimer =
            (days == 0 ? "" : days + " Days ") +
            (hours == 0 ? "" : hours + " Hour ") +
            (minutes == 0 ? "" : minutes + " Mins ");
        var myEle = document.getElementById("exp");
        if (myEle) {
            document.getElementById("exp").innerHTML = filtertimer;
        } else {
            clearInterval(x);
        }
        if (t < 0) {
            clearInterval(x);
            document.getElementById("exp").innerHTML =
                "Your Usage Time Has Ended";
        }
    }, 1000);
}
function available(deadline) {
    document.getElementById("available").innerHTML = "Retrieving Data...";
    var deadline = new Date(deadline).getTime();
    var x = setInterval(function () {
        var now = new Date().getTime();
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        var filtertimer =
            (days == 0 ? "" : days + " Days ") +
            (hours == 0 ? "" : hours + " Hour ") +
            (minutes == 0 ? "" : minutes + " Mins ") +
            seconds +
            " Sec ";
        var myEle = document.getElementById("available");
        if (myEle) {
            document.getElementById("available").innerHTML = filtertimer;
        } else {
            clearInterval(x);
        }
        if (t < 0) {
            clearInterval(x);
            document.getElementById("available").innerHTML =
                '<span class="badge bg-success" style="font-size: 18px">Available</span>';
        }
    }, 1000);
}
