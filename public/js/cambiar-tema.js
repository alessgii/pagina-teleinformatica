function toggleTheme() {
    const h = document.documentElement, d = h.getAttribute('data-theme') === 'dark';
    h.setAttribute('data-theme', d ? 'light' : 'dark');
    document.getElementById('ti-sun').style.display = d ? 'none' : 'block';
    document.getElementById('ti-moon').style.display = d ? 'block' : 'none';
    document.getElementById('t-label').textContent = d ? 'Oscuro' : 'Claro';
}
document.querySelectorAll('.f-btn').forEach(b => b.addEventListener('click', () => {
    document.querySelectorAll('.f-btn').forEach(x => x.classList.remove('active')); b.classList.add('active');
}));
document.querySelectorAll('.pg').forEach(b => b.addEventListener('click', () => {
    if (b.textContent === '‹' || b.textContent === '›') return;
    document.querySelectorAll('.pg').forEach(x => x.classList.remove('active')); b.classList.add('active');
}));
function openModal() { document.getElementById('overlay').classList.add('open'); document.body.style.overflow = 'hidden'; }
function closeModal() { document.getElementById('overlay').classList.remove('open'); document.body.style.overflow = ''; }
function closeOut(e) { if (e.target === document.getElementById('overlay')) closeModal(); }
document.querySelector('.compose').addEventListener('click', openModal);