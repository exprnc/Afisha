function artistToggleText() {
    let artistInfoText = document.querySelector('.artist-info-text');
    let artistExpA = document.querySelector('.expandable-text-a');
    if(artistInfoText.style.maxHeight === '150px' || artistInfoText.style.maxHeight === ''){
        artistInfoText.style.maxHeight = '100%';
        artistExpA.innerHTML = "Скрыть текст"
    }else{
        artistInfoText.style.maxHeight = '150px';
        artistExpA.innerHTML = "Развернуть текст"
    }
}