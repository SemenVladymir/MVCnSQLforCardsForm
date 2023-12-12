function ChangeForm(btn) {
    if (btn.id === "extended") {
        document.getElementById("extend").hidden = false;
        document.getElementById("phone-box").hidden = true;
        document.getElementById("text").required = true;
        document.getElementById("createdate").required = true;
        document.getElementById("phone").required = false;
    }
    else if(btn.id === "onlytitle") {
        document.getElementById("extend").hidden = true;
        document.getElementById("phone-box").hidden = true;
        document.getElementById("text").required = false;
        document.getElementById("createdate").required = false;
        document.getElementById("phone").required = false;
    }
    else if (btn.id === "addphone")
    {
        document.getElementById("extend").hidden = false;
        document.getElementById("phone-box").hidden = false;
        document.getElementById("text").required = true;
        document.getElementById("createdate").required = true;
        document.getElementById("phone").required = true;
    }
}

function ChangeStyle(btn) {
    if (btn.checked) {
        document.body.style.background = "#FFE4FFFF";
        document.querySelectorAll('.form-row label').forEach(item=> {
            item.style.color = "white";});
        document.querySelectorAll('div .block').forEach(item=> {
            item.style.color = "white";});
        document.getElementById("form").style.color = "red";
        document.getElementById("head").style.color = "red";
        document.getElementById("form").style.background = "#f5a1ad";
        document.getElementById("submit").style.background = "red";
        document.getElementById("radiobuttons").style.borderColor = "white";
    }
    else {
        document.body.style.background = "#e6f4fd";
        document.querySelectorAll('.form-row label').forEach(item=> {
            item.style.color = "#9d959d";});
        document.querySelectorAll('div .block').forEach(item=> {
            item.style.color = "#9d959d";});
        document.getElementById("form").style.color = "#9d959d";
        document.getElementById("head").style.color = "#4a90e2";
        document.getElementById("form").style.background = "#FFFFFFFF";
        document.getElementById("submit").style.background = "#4a90e2";
        document.getElementById("radiobuttons").style.borderColor = "#9d959d";
    }
}