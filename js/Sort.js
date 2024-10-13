function updateContentByMonth() {
    const urlParams = new URLSearchParams(window.location.search);
    const month = urlParams.get('month');

    console.log('Month:', month);

    #display all if no month chosen
    if (month == null) {
        displayAllPosts();
        return;
    }
    
    const selectedPosts = posts[month] || [];
    let contentHtml = "";

        if (selectedPosts.length > 0) {
            selectedPosts.forEach(post => {
                contentHtml += `
                    <article class='Content BlogPosts'>
                        <h2>${post.title}</h2>
                        <h6>${post.date}</h6>
                        <p>${post.content}</p>
                    </article>
                `;
            });
        } else {
            contentHtml += `
            <article class='Content BlogPosts'>
                <h2> Empty Blog</h2>
                <h6> No posts available </h6>
                <p>0 results</p>"
            </article>
            `;
        }

    
    document.getElementById('BlogToLoad').innerHTML = contentHtml;
    
}

// Call the function to display all posts
updateContentByMonth();
// Call the function to display posts based on the URL
// Add an event listener to call the function whenever the URL changes
window.addEventListener('popstate', updateContentByMonth);
