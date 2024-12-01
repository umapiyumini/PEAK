function showSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    
    document.getElementById(sectionId).classList.add('active');
    
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelector([onclick="showSection('${sectionId}')"]).classList.add('active');
}

function openModal(requestId, section) {
    // const modalId = ${section}Modal;
    const modal = document.getElementById(modalId);
    const formDetails = modal.querySelector('.form-details');
    
    const requestDetails = getRequestDetails(requestId, section);
    formDetails.innerHTML = generateModalContent(requestDetails);
    
    modal.style.display = 'block';
}

function closeModal(section) {
    // document.getElementById(${section}Modal).style.display = 'none';
}

function generateModalContent(details) {
    const fields = {
        'colors-night': ['Sport', 'Achievement', 'Year', 'Event'],
        'certificates': ['Certificate Type', 'Purpose', 'Urgency'],
        'medical': ['Condition', 'Doctor Name', 'Hospital', 'Appointment Date'],
        'transport': ['Destination', 'Date', 'Purpose', 'Number of Students'],
        'hostel': ['Facility Type', 'Issue Description', 'Room Number', 'Priority']
    };

    let html = `
        <div class="detail-row">
            <div class="detail-label">Request ID:</div>
            <div class="detail-value">${details.id}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Student Name:</div>
            <div class="detail-value">${details.studentName}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Student ID:</div>
            <div class="detail-value">${details.studentId}</div>
        </div>
    `;

    // Add section-specific fields
    fields[details.section].forEach(field => {
        html += `
            <div class="detail-row">
                <div class="detail-label">${field}:</div>
                <div class="detail-value">${details[field.toLowerCase()] || 'N/A'}</div>
            </div>
        `;
    });

    return html;
}

function getRequestDetails(requestId, section) {
    // Simulated data - replace with actual API call
    return {
        id: requestId,
        studentName: 'John Doe',
        studentId: 'STU001',
        section: section,
        sport: 'Cricket',
        achievement: 'First Place',
        year: '2024',
        event: 'University Games',
        // Add other section-specific fields as needed
    };
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modals = document.getElementsByClassName('modal');
    Array.from(modals).forEach(modal => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
}

// Handle approve/reject actions
function handleAction(requestId, section, action) {
    // console.log(Request ${requestId} from ${section} ${action});
    // Implement actual approval/rejection logic here
}


// Data structure for sample nominations
const sampleNominations = {
    colors: [
        { studentName: 'Alex Smith', studentId: 'ST001', achievement: 'National Level Participation', qualified: true },
        { studentName: 'Emma Wilson', studentId: 'ST002', achievement: 'University Record Holder', qualified: true },
        { studentName: 'Mark Johnson', studentId: 'ST003', achievement: 'Inter-University Runner-up', qualified: false }
    ],
    merits: [
        { studentName: 'Sarah Brown', studentId: 'ST004', achievement: 'Best Performance 2024', qualified: true },
        { studentName: 'James Davis', studentId: 'ST005', achievement: 'Most Improved Player', qualified: true }
    ],
    specialAwards: [
        { studentName: 'Lisa Anderson', studentId: 'ST006', awardCategory: 'Best Sportsperson', qualified: true },
        { studentName: 'Tom Wilson', studentId: 'ST007', awardCategory: 'Leadership Excellence', qualified: false }
    ]
};

function showSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
    
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelector([onclick="showSection('${sectionId}')"]).classList.add('active');
}

function openModal(requestId, section) {
    // const modalId = ${section}Modal;
    const modal = document.getElementById(modalId);
    
    if (section === 'colors-night') {
        populateColorsNightModal(requestId);
    } else {
        const formDetails = modal.querySelector('.form-details');
        const requestDetails = getRequestDetails(requestId, section);
        formDetails.innerHTML = generateModalContent(requestDetails);
    }
    
    modal.style.display = 'block';
}

function populateColorsNightModal(requestId) {
    // Populate basic request details
    document.getElementById('requestId').textContent = requestId;
    document.getElementById('studentName').textContent = 'Team Captain Name';
    document.getElementById('studentId').textContent = 'TC001';
    document.getElementById('sport').textContent = 'Cricket';
    document.getElementById('year').textContent = '2024';

    // Populate tables
    populateNominationsTable('colorsTableBody', sampleNominations.colors);
    populateNominationsTable('meritsTableBody', sampleNominations.merits);
    populateNominationsTable('specialAwardsTableBody', sampleNominations.specialAwards);
}

function populateNominationsTable(tableId, nominations) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    nominations.forEach(nomination => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${nomination.studentName}</td>
            <td>${nomination.studentId}</td>
            <td>${nomination.awardCategory || nomination.achievement}</td>
            <td>
                <input type="checkbox" 
                       ${nomination.qualified ? 'checked' : ''} 
                       onchange="updateQualification('${nomination.studentId}', this.checked)"
                       class="qualification-checkbox">
            </td>
        `;
        tbody.appendChild(row);
    });
}

function updateQualification(studentId, isQualified) {
    // console.log(Updated qualification for student ${studentId}: ${isQualified});
    // Here you would typically update your backend
}

function closeModal(section) {
    // document.getElementById(${section}Modal).style.display = 'none';
}

// Handle clicking outside modal
window.onclick = function(event) {
    const modals = document.getElementsByClassName('modal');
    Array.from(modals).forEach(modal => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
}

function handleAction(requestId, section, action) {
    // Get all qualifications
    if (section === 'colors-night') {
        const qualifications = {
            colors: getQualificationsFromTable('colorsTableBody'),
            merits: getQualificationsFromTable('meritsTableBody'),
            specialAwards: getQualificationsFromTable('specialAwardsTableBody')
        };
        // console.log(${action} request ${requestId} with qualifications:, qualifications);
    } else {
        // console.log(${action} request ${requestId} from ${section});
    }
    // Here you would send the data to your backend
}

function getQualificationsFromTable(tableId) {
    const tbody = document.getElementById(tableId);
    const rows = tbody.getElementsByTagName('tr');
    const qualifications = [];

    Array.from(rows).forEach(row => {
        const cells = row.getElementsByTagName('td');
        qualifications.push({
            studentId: cells[1].textContent,
            qualified: cells[3].querySelector('input').checked
        });
    });

    return qualifications;
}

// Add CSS class for checked rows
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('qualification-checkbox')) {
        const row = e.target.closest('tr');
        row.classList.toggle('qualified', e.target.checked);
    }
});

// Global variable to store current request ID
let currentRequestId = null;

// Sample data for each request type
const requestData = {
    certificates: {
        'CERT001': {
            studentName: 'John Smith',
            studentId: 'ST1234',
            type: 'Sports Participation',
            purpose: 'University Application',
            urgency: 'High',
            requiredDate: '2024-12-15',
            notes: 'Need certificate for basketball tournament participation'
        }
    },
    medical: {
        'MED001': {
            studentName: 'Sarah Johnson',
            studentId: 'ST5678',
            condition: 'Sports Injury - Ankle Sprain',
            doctor: 'Dr. Williams, Sports Medicine Center',
            date: '2024-12-10',
            duration: '2 weeks',
            contact: '+94 71 234 5678',
            requirements: 'Physical therapy sessions needed'
        }
    },
    transport: {
        'TRANS001': {
            studentName: 'Michael Brown',
            studentId: 'ST9012',
            destination: 'National Stadium, Colombo',
            purpose: 'Inter-University Championships',
            date: '2024-12-20',
            students: '15',
            vehicle: 'Mini Bus',
            requirements: 'Air-conditioned vehicle needed for team'
        }
    },
    hostel: {
        'HOST001': {
            studentName: 'Emily Wilson',
            studentId: 'ST3456',
            room: 'B-204',
            facility: 'Plumbing',
            description: 'Leaking tap in bathroom',
            priority: 'Medium',
            time: 'After 2 PM',
            notes: 'Water wastage is significant'
        }
    }
};

function openModal(requestId, section) {
    currentRequestId = requestId;
    // const modalId = ${section}Modal;
    const modal = document.getElementById(modalId);
    
    if (section === 'colors-night') {
        populateColorsNightModal(requestId);
    } else {
        populateRequestModal(requestId, section);
    }
    
    modal.style.display = 'block';
}

function populateRequestModal(requestId, section) {
    const data = requestData[section][requestId] || getDefaultData();
    const prefix = section.substring(0, section === 'certificates' ? 4 : 3);
    
    // Populate all spans in the modal
    Object.keys(data).forEach(key => {
        // const span = document.getElementById(${prefix}-${key});
        if (span) {
            span.textContent = data[key];
        }
    });
    
    // document.getElementById(${prefix}-requestId).textContent = requestId;
}

function getDefaultData() {
    return {
        studentName: 'Not Available',
        studentId: 'Not Available'
    };
}

function closeModal(section) {
    // const modal = document.getElementById(${section}Modal);
    if (modal) {
        modal.style.display = 'none';
    }
    currentRequestId = null;
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
        currentRequestId = null;
    }
}