const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
        if (li.parentElement.classList.contains('sub')) {
            li.parentElement.parentElement.classList.add('active');
        }
    })
});



const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');
let sideBarClosed = false;
let sideBarClosedMemori = false;

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
        if(sideBarClosed == false){
            sideBarClosed = true;
            fetchDataNavBar(true);
        }
    } else if (window.innerWidth >= 768){
        if(sideBarClosedMemori == false){
            sideBar.classList.remove('close');
            if(sideBarClosed == true){
                sideBarClosed = false;
                fetchDataNavBar(false);
            }

        }else if(sideBarClosedMemori == true){

            sideBar.classList.add('close');
            if(sideBarClosed == false){
                sideBarClosed = true;
                fetchDataNavBar(true);
            }
        }



    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})

