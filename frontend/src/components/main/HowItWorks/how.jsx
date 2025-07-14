import React from "react";
import styles from "./how.module.css";
import { motion } from "framer-motion";
import homeImg from "../../../assets/images/home.jpg";
import libraryImg from "../../../assets/images/library.jpg";
import registerImg from "../../../assets/images/register.jpg";
import loginImg from "../../../assets/images/login.jpg";

const steps = [
  {
    label: "Step 1",
    title: "Sign Up ",
    desc: "Create your account and unlock a world of connections with the Quran.",
    img: registerImg,
  },
  {
    label: "Step 2",
    title: "Login to your Account",
    desc: "Access your preffered courses right on hand!",
    img: loginImg,
  },
  {
    label: "Step 3",
    title: "Start Nurturing you mind",
    desc: "Select , Learn and Enjoy Your Journey",
    img: homeImg,
  },
];

const HowItWorks = () => {
  return (
    <section className={styles.section} id="how">
      <div className={styles.container}>
        {/* LEFT STICKY SECTION */}
        <div className={styles.leftSticky}>
          <motion.h2
            className={styles.heading}
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
            style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
          >
            Get Started In Just <br />
            <span>3 simple Steps.</span>
          </motion.h2>
          <motion.p
            className={styles.subheading}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.2, duration: 0.6 }}
            style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
          >
            Three simple steps to unlock the power of Quran and revolutionize your Life.
          </motion.p>
        </div>

        {/* RIGHT SCROLLABLE CARDS */}
        <div className={styles.rightScroll}>
          {steps.map((step, i) => (
            <motion.div
              key={i}
              className={styles.card}
              initial={{ opacity: 0, y: 60 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.4 }}
              transition={{ delay: i * 0.2, duration: 0.5 }}
            >
              <div className={styles.cardContent}>
                <div className={styles.cardText}>
                  <p 
                    className={styles.stepLabel}
                    style={{ fontFamily: "'Inter', sans-serif", fontWeight: "500" }}
                  >
                    {step.label}
                  </p>
                  <h4 
                    className={styles.cardTitle}
                    style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
                  >
                    {step.title}
                  </h4>
                  <p 
                    className={styles.cardDesc}
                    style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
                  >
                    {step.desc}
                  </p>
                </div>
                <div className={styles.imageWrap}>
                  <img src={step.img} alt={`Visual for ${step.label}`} />
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default HowItWorks;
