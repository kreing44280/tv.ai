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
const hiddenInput = document.getElementById('news_tag');
const initialTags = hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);

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
tagInputField.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        addTag(tagInputField.value);
        tagInputField.value = '';
    }
});

// Prevent empty tags on blur
tagInputField.addEventListener('blur', () => {
    if (tagInputField.value.trim()) {
        addTag(tagInputField.value);
        tagInputField.value = '';
    }
});