function deleteMedia(e) {
    e.preventDefault();

    let res = confirm('Дійсно видалити?');

    if (res) {
        let link = e.target;

        sentPostQuery(link.href, null, (data) => {
            if (data.success) {
                if (link.closest('.form-group').querySelector('img')) {
                    link.closest('.form-group').querySelector('img').src = '';
                }
                if (link.closest('.form-group').querySelector('p')) {
                    link.closest('.form-group').querySelector('p').textContent = '';
                }
                link.remove();

                if (data.message) {
                    alert(data.message);
                }
            }
        });
    }
};

const sentPostQuery = (formUrl, formData, callback) => {
    document.body.classList.add('process');
    fetch(formUrl, {
        method: 'post',
        body: formData,
        headers: {
            "X-CSRF-Token": document.querySelector('[name="csrf-token"]').content
        },
    })
        .then(response => response.json())
        .then(callback)
        .catch((response) => {
        }).finally(() => {
            document.body.classList.remove('process');
        });
}


document.querySelectorAll('.delete-media-btn').forEach(btn => {
    btn.onclick = (e) => {
        e.preventDefault();
        deleteMedia(e);
    }
})