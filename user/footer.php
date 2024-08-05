<div id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                
                <h2>About Us</h2>
                <p>Welcome to our e-learning platform! We are dedicated to providing high-quality online education to learners of all ages and backgrounds. Whether you're a student looking to enhance your skills, a professional seeking to advance your career, or someone simply eager to explore new subjects, we have something for everyone.</p>
            </div>
            <div class="col-md-6">
               
                <h2>Follow Us</h2>
                <div class="social-icons">
                    <a href="https://youtu.be/a6IhSV-4w-A?si=3WAjlEgC3SPBItQa"><i class="fab fa-youtube"></i></a> <!-- Updated icon to YouTube -->
                    <a href=" https://x.com/BabbluSz?t=l7Av9hhJsniL7fl14IQiPg&s=08"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/naveen.0101?igsh=MXFzOXNseXU3OXA1aw=="><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactUsLink = document.querySelector('.navbar .nav-link[href="#contactUs"]');
        if (contactUsLink) {
            contactUsLink.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('#footer').scrollIntoView({ behavior: 'smooth' });
            });
        }
    });
</script>