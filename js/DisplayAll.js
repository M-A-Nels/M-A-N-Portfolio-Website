// DisplayAll.js

// Sample data for posts
const posts = {
    January: [
        { title: "January Post 1", date: "01st January 2024 12:00 UTC", content: "This is the first January post." },
        { title: "January Post 2", date: "02nd January 2024 12:00 UTC", content: "This is the second January post." }
    ],
    February: [
        { title: "February Post 1", date: "01st February 2024 12:00 UTC", content: "This is the first February post." },
        { title: "February Post 2", date: "02nd February 2024 12:00 UTC", content: "This is the second February post." }
    ],
    // Add more months as needed
};

// Function to display all posts
function displayAllPosts() {
    let contentHtml = '';
    Object.keys(posts).forEach(month => {
        posts[month].forEach(post => {
            contentHtml += `
                <article class='Content BlogPosts'>
                    <h2>${post.title}</h2>
                    <h6>${post.date}</h6>
                    <p>${post.content}</p>
                </article>
                `;
        });
    });

    // Display the posts
    document.getElementById('BlogToLoad').innerHTML = contentHtml;
}
