let confP = document.querySelector(".conf");
let confT = document.querySelector(".confT")


// project 
if (confP) {
    document.querySelector(".conf").addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to delete this project? ')) {
            e.preventDefault();
        }
    })

}


// task
if (confT) {
    document.querySelector(".confT").addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to delete this Task? ')) {
            e.preventDefault();
        }
    })
}


