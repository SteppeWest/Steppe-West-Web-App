document.addEventListener('click', function (e) {
	const a = e.target.closest('a[data-sw-lang="1"]');
	if (!a) return;

	const menu = a.closest('.dropdown-menu');
	if (!menu) return;

	const toggle = document.querySelector('[data-bs-toggle="dropdown"][aria-expanded="true"]');
	if (!toggle) return;

	const dd = bootstrap.Dropdown.getInstance(toggle);
	if (dd) dd.hide();
});
