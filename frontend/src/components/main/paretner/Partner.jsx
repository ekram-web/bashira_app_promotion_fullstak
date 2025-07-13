import React from "react";
import styles from "./partner.module.css";
import skylinkLogo from "../../../assets/skylink.svg";

function Partner() {
  return (
    <section className={styles.partnerSection}>
      <h2
        className={styles.heading}
        style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
      >
        Our Partner
      </h2>
      <div className={styles.partnerBadge}>
        <div className={styles.logoRing}>
          <img
            src={skylinkLogo}
            alt="Skylink logo"
            className={styles.partnerLogo}
          />
        </div>
        <div className={styles.partnerLabel}>Official Partner</div>
        <div
          className={styles.partnerDesc}
          style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
        >
          Proudly partnering with Skylink to empower learning.
        </div>
      </div>
    </section>
  );
}

export default Partner;
