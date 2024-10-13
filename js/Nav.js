function OpenMenu() {
    if (document.getElementById("NavOptions").style.display === 'block' && window.innerWidth < 940) {
        document.getElementById("NavOptions").style.display = 'none';
    }
    else {
        document.getElementById("NavOptions").style.display = 'block';   
    }
}
