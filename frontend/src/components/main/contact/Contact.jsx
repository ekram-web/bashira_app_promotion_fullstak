import React, { useEffect, useState } from "react";
import styles from "./Contact.module.css";
import basirahLogo from "../../../assets/images/Basirah Logo Full Color(Transparent).png";
import { FiUser, FiMail, FiMessageCircle, FiEdit2 } from "react-icons/fi";
import { sendContactMessage } from "../../../api/contact";
import { fetchContactInfo } from "../../../api/contactInfo";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function Contact() {
  const [contactInfo, setContactInfo] = useState(null);
  const [form, setForm] = useState({
    name: "",
    email: "",
    subject: "",
    message: "",
  });

  useEffect(() => {
    fetchContactInfo()
      .then((res) => setContactInfo(res.data))
      .catch(() => setContactInfo(null));
  }, []);

  // For the map data
  const [mapData, setmapData] = useState(null);

  useEffect(() => {
    fetchContactInfo()
      .then((res) => setmapData(res.data))

      .catch(() => setmapData(null));
  }, []);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await sendContactMessage(form);
      toast.success("Thank you for contacting us!.");
      setForm({ name: "", email: "", subject: "", message: "" });
    } catch (err) {
      toast.error(
        err.response?.data?.error ||
          "Sorry, something went wrong. Please try again."
      );
    }
  };

  return (
    <section className={styles.contactSection} id="contact">
      {/* Left Panel: Map, Logo, Text */}
      <div className={styles.leftPanel}>
        <div className={styles.mapCard}>
          <iframe
            title="Basirah Location Map"
            src={
              mapData && mapData.mapUrl
                ? mapData.mapUrl
                : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.123456789012!2d-122.419415684681!3d37.774929279759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c8b8b8b8b%3A0x8b8b8b8b8b8b8b8b!2sBasirah%20Institute%20of%20Quranic%20Studies!5e0!3m2!1sen!2sus!4v1616161616161"
            }
            style={{
              width: "100%",
              height: "120px",
              border: 0,
              borderRadius: "12px",
            }}
            allowFullScreen=""
            loading="lazy"
            aria-label="Basirah location map"
          ></iframe>
        </div>
        <img
          src={basirahLogo}
          alt="Basirah logo"
          className={styles.logoSmall}
        />
        <div className={styles.inviteText}>
          <h2
            style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
          >
            Let's Connect!
          </h2>
          <p style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}>
            We're here to help you grow, learn, and connect. Reach out to
            Basirah for support, partnership, or just to say hello.
          </p>
        </div>
      </div>
      {/* Right Panel: Minimal Form with Icons */}
      <form
        className={styles.glassForm}
        autoComplete="off"
        aria-label="Contact Basirah form"
        onSubmit={handleSubmit}
      >
        <div
          className={styles.formTitle}
          style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
        >
          Contact Basirah
        </div>
        <div className={styles.inputGroup}>
          <FiUser className={styles.inputIcon} />
          <input
            className={styles.input}
            type="text"
            name="name"
            placeholder="Your Name"
            aria-label="Your Name"
            value={form.name}
            onChange={handleChange}
            required
          />
        </div>
        <div className={styles.inputGroup}>
          <FiMail className={styles.inputIcon} />
          <input
            className={styles.input}
            type="email"
            name="email"
            placeholder="Your Email"
            aria-label="Your Email"
            value={form.email}
            onChange={handleChange}
            required
          />
        </div>
        <div className={styles.inputGroup}>
          <FiEdit2 className={styles.inputIcon} />
          <input
            className={styles.input}
            type="text"
            name="subject"
            placeholder="Subject"
            aria-label="Subject"
            value={form.subject}
            onChange={handleChange}
            required
          />
        </div>
        <div className={styles.textareaGroup}>
          <FiMessageCircle className={styles.textareaIcon} />
          <textarea
            className={styles.textarea}
            name="message"
            placeholder="Your Message"
            rows={5}
            aria-label="Your Message"
            value={form.message}
            onChange={handleChange}
            required
          ></textarea>
        </div>
        <button
          className={styles.submitBtn}
          type="submit"
          aria-label="Send Message"
        >
          Send Message
        </button>
      </form>
      <ToastContainer position="top-center" autoClose={3000} />
    </section>
  );
}
