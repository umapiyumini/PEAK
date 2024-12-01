// DOM Elements
const titleInput = document.getElementById('title-input');
const contentInput = document.getElementById('content-input');
const saveDraftButton = document.getElementById('save-draft');
const publishButton = document.getElementById('publish');
const draftsList = document.getElementById('drafts-list');
const rulesList = document.getElementById('rules-list');

// State for storing drafts and published rules
let drafts = [];
let publishedRules = [];

// Utility function to create a rule card
function createRuleCard(title, content, isDraft = false) {
    const ruleCard = document.createElement('div');
    ruleCard.className = 'rule';
    
    const ruleContent = document.createElement('div');
    ruleContent.className = 'rule-content';
    ruleContent.innerHTML = `
        <h3>${title}</h3>
        <p>${content}</p>
    `;
    
    const actionButtons = document.createElement('div');
    actionButtons.className = 'action-buttons';

    if (isDraft) {
        const editButton = document.createElement('button');
        editButton.className = 'edit-button';
        editButton.textContent = 'Edit';
        editButton.onclick = () => editDraft(title, content);

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = () => deleteDraft(title);

        actionButtons.append(editButton, deleteButton);
    } else {
        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = () => deletePublishedRule(title);

        actionButtons.append(deleteButton);
    }

    ruleCard.append(ruleContent, actionButtons);
    return ruleCard;
}

// Save as Draft
saveDraftButton.addEventListener('click', () => {
    const title = titleInput.value.trim();
    const content = contentInput.value.trim();

    if (!title || !content) {
        alert('Please provide both a title and content.');
        return;
    }

    drafts.push({ title, content });
    updateDraftsList();
    clearForm();
});

// Publish Rule
publishButton.addEventListener('click', () => {
    const title = titleInput.value.trim();
    const content = contentInput.value.trim();

    if (!title || !content) {
        alert('Please provide both a title and content.');
        return;
    }

    publishedRules.push({ title, content });
    updatePublishedRulesList();
    clearForm();
});

// Edit Draft
function editDraft(title, content) {
    // Populate form with draft details
    titleInput.value = title;
    contentInput.value = content;

    // Remove the draft from the list
    drafts = drafts.filter(draft => draft.title !== title);
    updateDraftsList();
}

// Delete Draft
function deleteDraft(title) {
    drafts = drafts.filter(draft => draft.title !== title);
    updateDraftsList();
}

// Delete Published Rule
function deletePublishedRule(title) {
    publishedRules = publishedRules.filter(rule => rule.title !== title);
    updatePublishedRulesList();
}

// Update Drafts List
function updateDraftsList() {
    draftsList.innerHTML = '';
    if (drafts.length === 0) {
        draftsList.innerHTML = '<p>No draft rules available.</p>';
    } else {
        drafts.forEach(draft => {
            const draftCard = createRuleCard(draft.title, draft.content, true);
            draftsList.appendChild(draftCard);
        });
    }
}

// Update Published Rules List
function updatePublishedRulesList() {
    rulesList.innerHTML = '';
    if (publishedRules.length === 0) {
        rulesList.innerHTML = '<p>No published rules yet.</p>';
    } else {
        publishedRules.forEach(rule => {
            const ruleCard = createRuleCard(rule.title, rule.content, false);
            rulesList.appendChild(ruleCard);
        });
    }
}

// Clear Form Inputs
function clearForm() {
    titleInput.value = '';
    contentInput.value = '';
}
