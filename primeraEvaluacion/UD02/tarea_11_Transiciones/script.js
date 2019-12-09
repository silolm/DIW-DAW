document.querySelector('button').addEventListener('click', () => {
    document.querySelectorAll('.caja').forEach(element => element.classList.toggle('transicion'));
});