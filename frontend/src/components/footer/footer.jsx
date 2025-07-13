import React, { useEffect, useState } from "react";
import styles from "./footer.module.css";
import logo from "../../assets/images/Basirah Full Color Transparent.png";
import skylink from "../../assets/images/logo.png";
import { FaFacebookF, FaTiktok, FaInstagram } from "react-icons/fa";
import { fetchContactInfo } from "../../api/contactInfo";

const navLinks = [
  { name: "Home", href: "#hero" },
  { name: "About", href: "#about" },
  { name: "What We Offer", href: "#offer" },
  { name: "Contact", href: "#contact" },
];

function Footer() {
  const [footerData, setfooterData] = useState(null);

  useEffect(() => {
    fetchContactInfo()
      .then((res) => setfooterData(res.data))

      .catch(() => setfooterData(null));
  }, []);
  return (
    <footer className={styles.footer}>
      <div className={styles.wave}></div>
      <div className={styles.footerContent}>
        <div className={styles.leftColumn}>
          <div className={styles.logoBlock}>
            <img src={logo} alt="Basirah Logo" className={styles.footerLogo} />
            <div className={styles.poweredBy}>
              <p>Powered by</p>
              <img
                src={skylink}
                alt="Partner Logo"
                className={styles.partnerLogo}
              />
            </div>
          </div>
        </div>
        <div className={styles.middleColumn}>
          <nav className={styles.footerNavMenu}>
            <ul>
              {navLinks.map((link) => (
                <li key={link.name}>
                  <a href={link.href}>{link.name}</a>
                </li>
              ))}
            </ul>
          </nav>
        </div>
        <div className={styles.rightColumn}>
          <div className={styles.footerAddress}>
            <strong>Address:</strong>
            <br />
            {footerData && footerData.address
              ? footerData.address
              : "123 Qur'anic Studies Ave, City, Country"}
          </div>
          <div className={styles.footerPhone}>
            <strong>Phone:</strong>
            {footerData && footerData.phone ? footerData.phone : "123-456-7890"}
          </div>
          <div className={styles.socials}>
            <a
              href="https://facebook.com"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Facebook"
            >
              <FaFacebookF size={24} />
            </a>
            <a
              href="https://tiktok.com"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Tiktok"
            >
              <FaTiktok size={24} />
            </a>
            <a
              href="https://instagram.com"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Instagram"
            >
              <FaInstagram size={24} />
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
