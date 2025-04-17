document.addEventListener('DOMContentLoaded', function () {
    const fixedTopup = document.getElementById('fixed-topup');
    if (fixedTopup) {
        fixedTopup.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// Tag input
const tagInput = document.getElementById('tagInput');
const tagInputField = document.getElementById('tagInputField');
const hiddenInput = document.getElementById('news_tags');
const initialTags = hiddenInput ? hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag) : [];

function addTag(tag) {
    tag = tag.trim();
    if (!tag) return;

    const existingTags = Array.from(tagInput.querySelectorAll('.tag')).map(t => t.textContent.trim());
    if (existingTags.includes(tag)) return;

    const tagElement = document.createElement('div');
    tagElement.classList.add('tag');
    tagElement.textContent = tag;

    const closeButton = document.createElement('span');
    closeButton.classList.add('tag-close');
    closeButton.textContent = '×';
    closeButton.onclick = () => {
        tagElement.remove();
        updateHiddenInput();
    };

    tagElement.appendChild(closeButton);
    tagInput.insertBefore(tagElement, tagInputField);

    updateHiddenInput();
}

function updateHiddenInput() {
    const tags = Array.from(tagInput.querySelectorAll('.tag')).map(t => t.textContent.trim());
    hiddenInput.value = tags.join(',');
}

if (tagInputField) {
    tagInputField.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTag(tagInputField.value);
            tagInputField.value = '';
        }
    });

    tagInputField.addEventListener('blur', () => {
        if (tagInputField.value.trim()) {
            addTag(tagInputField.value);
            tagInputField.value = '';
        }
    });
}

initialTags.forEach(addTag);

// Datepicker
$('#startDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    width: 'auto',
    height: 'auto'
});

$('#endDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    width: 'auto',
    height: 'auto'
});

// Quill editor
var quillContainer = document.querySelector('#news_content');
if (quillContainer) {
    var quill = new Quill(quillContainer, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'align': []
                }],
                ['link', 'image', 'video'],
                ['clean'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
            ]
        }
    });

    quill.getModule('toolbar').addHandler('image', () => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            const formData = new FormData();
            formData.append('image', file);

            fetch('/upload-image', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', `${data.url}`);
                })
                .catch(error => console.log(error));
        }
    });
}

// Copy text AI
function copyTextAIFunc() {
    const news_title_ai = $('#news_title_ai').val();
    const news_content_ai = $('#news_content_ai').val();
    if (news_title_ai == '' || news_content_ai == '') {
        Swal.fire({
            icon: 'error',
            text: 'กรุณากรอกข้อมูลให้ครบ !',
        })
        return false;
    }
    $('#news_title').val(news_title_ai);
    $('#news_content').val(news_content_ai);
}

function copyTextAICancelFunc (news_title, news_content) {
    $('#news_title').val(news_title);
    $('#news_content').val(news_content);
}

// Submit form
$("#newsForm").submit(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "ต้องการแก้ไขข้อมูลข่าวสาร!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        } else {
            return false;
        }
    });
});

