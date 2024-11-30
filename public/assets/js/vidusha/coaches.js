document.addEventListener("DOMContentLoaded", () => {
    const combinedData = [
        {
            name: "Mr. H.A. Perera",
            role: "Coach",
            telephone: "+1234567890",
            email: "perera@gmail.com",
            address: "123 Main St, Colombo",
            experience: "10 years of coaching experience",
            image: "pro_icon.png"
        },
        {
            name: "Mr. Nihal Silva",
            role: "Coach",
            telephone: "+1122334455",
            email: "nihal2gmail.com",
            address: "789 Main St,Colombo",
            experience: "8 years of coaching experience",
            image: "pro_icon.png"
        },
        {
            name: "Mr. D.L Fernando",
            role: "Instructor",
            telephone: "+2233445566",
            email: "lalan@gmail.com",
            address: "101 Main St,Colombo",
            experience: "3 years of teaching experience",
            image: "pro_icon.png"
        }
    ];

    const container = document.getElementById("combined-container");

    combinedData.forEach(person => {
        const card = document.createElement("div");
        card.classList.add("tile");
        card.innerHTML = `
            <img src="${person.image}" alt="${person.name}" />
            <h3>${person.name}</h3>
            <p><strong>Role:</strong> ${person.role}</p>
            <p><strong>Phone:</strong> ${person.telephone}</p>
            <p><strong>Email:</strong> ${person.email}</p>
            <p><strong>Address:</strong> ${person.address}</p>
            <p><strong>Experience:</strong> ${person.experience}</p>
        `;
        container.appendChild(card);
    });
});
