import React, { useEffect, useRef, useState } from 'react';
import styles from './offer.module.css';
import { fetchOffers } from '../../../api/offers';

// Fallback offers in case API fails
const fallbackOffers = [
  ['Simplified', 'Complex tasks are now simple'],
  ['Boost Productivity', 'Perform Tasks in less time'],
  ['Facilitated learning', 'Train anyone from anywhere'],
  ['Support', 'Now it\'s 24/7 support'],
];

const WhatWeOffer = () => {
  const [offers, setOffers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [title, setTitle] = useState('What We Offer');
  const [subtitle, setSubtitle] = useState('Discover the comprehensive features and benefits that make Basirah Institute the leading platform for Qur\'anic education. Our innovative approach combines traditional Islamic scholarship with modern technology to create an unparalleled learning experience.');
  
  const cardsRef = useRef([]);
  const scrollWrapperRef = useRef(null);
  const hasScrolledToNextSection = useRef(false);

  useEffect(() => {
    fetchOffers()
      .then((res) => {
        console.log('Offers API response:', res.data);
        
        // Get section title and description from the first offer
        if (res.data.length > 0) {
          const firstOffer = res.data[0];
          if (firstOffer.section_title) {
            setTitle(firstOffer.section_title);
          }
          if (firstOffer.section_description) {
            setSubtitle(firstOffer.section_description);
          }
        }
        
        // Transform backend data to match frontend format
        const transformedOffers = res.data.map((offer) => [
          offer.title || 'Title',
          offer.subtitle || offer.description || 'Description'
        ]);
        console.log('Transformed offers:', transformedOffers);
        setOffers(transformedOffers);
        setLoading(false);
      })
      .catch((error) => {
        console.error('Error fetching offers:', error);
        // Use fallback data if API fails
        setOffers(fallbackOffers);
        setLoading(false);
      });
  }, []);

  useEffect(() => {
    const rotateCards = () => {
      let angle = 0;
      cardsRef.current.forEach((card, index) => {
        if (card.classList.contains(styles.away)) {
          card.style.transform = `translateY(-120vh) rotate(-48deg)`;
        } else {
          card.style.transform = `rotate(${angle}deg)`;
          angle -= 10;
          card.style.zIndex = cardsRef.current.length - index;
        }
      });
    };

    const resetCards = () => {
      cardsRef.current.forEach((card) => {
        card.classList.remove(styles.away);
      });
      rotateCards();
      hasScrolledToNextSection.current = false;
      
      // Reset scroll wrapper state
      if (scrollWrapperRef.current) {
        scrollWrapperRef.current.classList.remove(styles.scrollWrapperReleased);
        scrollWrapperRef.current.scrollTop = 0;
      }
      // Scroll the section into view at the top
      const section = document.getElementById('offer');
      if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    };

    const scrollToNextSection = () => {
      const currentSection = document.getElementById('offer');
      if (currentSection && currentSection.nextElementSibling) {
        currentSection.nextElementSibling.scrollIntoView({ 
          behavior: 'smooth',
          block: 'start'
        });
        
        // Reset cards after scrolling to next section
        setTimeout(() => {
          resetCards();
        }, 1000);
      }
    };

    const handleScroll = () => {
      if (!scrollWrapperRef.current) return;

      const scrollTop = scrollWrapperRef.current.scrollTop;
      const distance = window.innerHeight * 0.5;
      const index = Math.floor(scrollTop / distance);

      // Update card classes
      cardsRef.current.forEach((card, i) => {
        if (i <= index) {
          card.classList.add(styles.away);
        } else {
          card.classList.remove(styles.away);
        }
      });

      rotateCards();

      // Check if all cards are gone and we haven't already scrolled to next section
      if (index >= cardsRef.current.length && !hasScrolledToNextSection.current) {
        hasScrolledToNextSection.current = true;
        scrollWrapperRef.current.classList.add(styles.scrollWrapperReleased);
        // Auto-scroll to next section after a brief delay
        setTimeout(() => {
          scrollToNextSection();
        }, 800);
      } else if (index < cardsRef.current.length) {
        // If user scrolls back up, immediately reset cards and scroll position
        if (hasScrolledToNextSection.current) {
          resetCards();
        } else {
          scrollWrapperRef.current.classList.remove(styles.scrollWrapperReleased);
        }
      }
    };

    if (scrollWrapperRef.current) {
      rotateCards();
      scrollWrapperRef.current.addEventListener('scroll', handleScroll);
    }

    return () => {
      if (scrollWrapperRef.current) {
        scrollWrapperRef.current.removeEventListener('scroll', handleScroll);
      }
    };
  }, [offers.length]);

  if (loading) {
    return (
      <section className={styles.section} id="offer">
        <div className={styles.scrollWrapper} ref={scrollWrapperRef}>
          <div className={styles.stackArea}>
            <div className={styles.left}>
              <div 
                className={styles.title}
                style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
              >
                {title}
              </div>
                          <div 
              className={styles.subTitle}
              style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
            >
              Loading our amazing features...
            </div>
            </div>
            <div className={styles.right}>
              <div className={styles.card}>
                <div style={{ textAlign: 'center', padding: '2rem' }}>
                  Loading...
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section className={styles.section} id="offer">
    <div className={styles.scrollWrapper} ref={scrollWrapperRef}>
      <div className={styles.stackArea}>
        <div className={styles.left}>
          <div 
            className={styles.title}
            style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
          >
            {title}
          </div>
          <div 
            className={styles.subTitle}
            style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
          >
            {subtitle}
            <br />
          </div>
        </div>
        <div className={styles.right}>
          {offers.map(([sub, content], index) => (
            <div
              key={index}
              className={styles.card}
              ref={(el) => (cardsRef.current[index] = el)}
            >
              <div 
                className={styles.sub}
                style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
              >
                {sub}
              </div>
              <div 
                className={styles.content}
                style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
              >
                {content}
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
    </section>
  );
};

export default WhatWeOffer;
