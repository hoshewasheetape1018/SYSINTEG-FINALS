        </section>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('[data-admin-search]').forEach(function(input) {
    input.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const target = document.querySelector(this.dataset.adminSearch);
        target?.querySelectorAll('[data-admin-row]').forEach(function(row) {
            row.hidden = query !== '' && !row.textContent.toLowerCase().includes(query);
        });
    });
});
</script>
</body>
</html>
