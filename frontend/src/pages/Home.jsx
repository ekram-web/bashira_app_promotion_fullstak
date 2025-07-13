import React from "react";
import Header from "../components/header/Header.jsx";
import Footer from "../components/footer/footer.jsx";
import Hero from "../components/main/hero/Hero.jsx";
import Promote from "../components/main/promotion2/Promote.jsx";
// import Partner from "../components/main/paretner/Partner.jsx";
import Review from "../components/main/reviews/Review.jsx";
import About from "../components/main/about/About.jsx";
import Contact from "../components/main/contact/Contact.jsx";
import "../App.css";
import WhatWeOffer from "../components/main/WhatWeOffer/offer.jsx";
import HowItWorks from "../components/main/HowItWorks/how.jsx";
import YoutubeVideos from "../components/main/youtube/YoutubeVideos.jsx";

function Home() {
  return (
    <>
      <Header />
      <div className="main-content-with-padding">
        <Hero />
        <About />
        <WhatWeOffer />

        <Promote />
        <HowItWorks />
        <Review />
        <YoutubeVideos />
        {/* <Partner /> */}
        <Contact />

        <Footer />
      </div>
    </>
  );
}

export default Home;
