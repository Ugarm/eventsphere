import { useState, useEffect, useRef } from "react";
import styles from "./carousel.module.scss";
import SearchBar from "../searchbar/SearchBar";
import beachImage from "../../../../../src/images/carouselBeach.avif";
import concertImage from "../../../../../src/images/carouselConcert.jpg";

const images = [beachImage, concertImage];

const Carousel = () => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const timeoutRef = useRef(null);
  const delay = 5000; // 5000ms -> 5 seconds

  useEffect(() => {
    resetTimeout();
    timeoutRef.current = setTimeout(
      () =>
        setCurrentIndex((prevIndex) =>
          prevIndex === images.length - 1 ? 0 : prevIndex + 1
        ),
      delay
    );

    return () => {
      resetTimeout();
    };
  }, [currentIndex]);

  function resetTimeout() {
    if (timeoutRef.current) {
      clearTimeout(timeoutRef.current);
    }
  }

  return (
    <div className={styles.carouselContainer}>
      <div className={styles.containerSearchBar}>
        <SearchBar />
      </div>
      <div className={styles.carousel}>
        <div
          className={styles.carouselInner}
          style={{ transform: `translateX(-${currentIndex * 100}%)` }}
        >
          {images.map((img, index) => (
            <div className={styles.carouselItem} key={index}>
              <img src={img} alt={`Slide ${index + 1}`} />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default Carousel;
