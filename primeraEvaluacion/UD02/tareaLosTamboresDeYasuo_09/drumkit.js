window.onload=init;


function suena(e){
    let audio;
    audio = document.querySelector(`audio[data-key="${e.keyCode}"]`);

    if (audio == null)return;

    const nuestroDiv = document.querySelector(`keys[data-key="${e.keyCode}"]`);
    nuestroDiv.classList.add("key");
    audio.currentTime=0;
    audio.play();


}


function init(){
    window.addEventListener("keydown",suena);
}

/*
window.addEventListener('keydown', () => {

});**/