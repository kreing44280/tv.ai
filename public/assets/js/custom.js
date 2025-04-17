document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('fixed-topup').addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

const tagInput = document.getElementById('tagInput');
const tagInputField = document.getElementById('tagInputField');
const hiddenInput = document.getElementById('news_tags');
const initialTags = hiddenInput ? hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag) : [];

// Populate initial tags
initialTags.forEach(addTag);

// Function to add a tag
function addTag(tag) {
    tag = tag.trim();
    if (!tag) return;

    // Avoid duplicates
    const existingTags = Array.from(tagInput.querySelectorAll('.tag')).map(t => t.textContent.trim());
    if (existingTags.includes(tag)) return;

    // Create tag element
    const tagElement = document.createElement('div');
    tagElement.classList.add('tag');
    tagElement.textContent = tag;

    // Add close button
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

// Update the hidden input value
function updateHiddenInput() {
    const tags = Array.from(tagInput.querySelectorAll('.tag')).map(t => t.textContent.trim());
    hiddenInput.value = tags.join(',');
}

// Handle input field events
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


// if (document.getElementById('tagInputHuman')) {
const tagInputHuman = document.getElementById('tagInputHuman');
const tagInputFieldHuman = document.getElementById('tagInputFieldHuman');
const hiddenInputHuman = document.getElementById('news_tag_human');
const initialTagsHuman = hiddenInputHuman ? hiddenInputHuman.value.split(',').map(tag => tag.trim()).filter(tag => tag) : [];

// Populate initial tags
initialTagsHuman.forEach(addTagHuman);

// Function to add a tag
function addTagHuman(tag) {
    tag = tag.trim();
    if (!tag) return;

    // Avoid duplicates
    const existingTags = Array.from(tagInputHuman.querySelectorAll('.tag')).map(t => t.textContent.trim());
    if (existingTags.includes(tag)) return;

    // Create tag element
    const tagElement = document.createElement('div');
    tagElement.classList.add('tag');
    tagElement.textContent = tag;

    // Add close button
    const closeButton = document.createElement('span');
    closeButton.classList.add('tag-close');
    closeButton.textContent = '×';
    closeButton.onclick = () => {
        tagElement.remove();
        updateHiddenInputHuman();
    };

    tagElement.appendChild(closeButton);
    tagInputHuman.insertBefore(tagElement, tagInputFieldHuman);

    updateHiddenInputHuman();
}

// Update the hidden input value
function updateHiddenInputHuman() {
    const tags = Array.from(tagInputHuman.querySelectorAll('.tag')).map(t => t.textContent.trim());
    hiddenInputHuman.value = tags.join(',');
}

// Handle input field events
if (tagInputFieldHuman) {
    tagInputFieldHuman.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTagHuman(tagInputFieldHuman.value);
            tagInputFieldHuman.value = '';
        }
    });

    // Prevent empty tags on blur
    tagInputFieldHuman.addEventListener('blur', () => {
        if (tagInputFieldHuman.value.trim()) {
            addTagHuman(tagInputFieldHuman.value);
            tagInputFieldHuman.value = '';
        }
    });
}
// }

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
