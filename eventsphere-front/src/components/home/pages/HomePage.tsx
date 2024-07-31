import styles from "./homepage.module.scss";
import EventCard from "../components/eventhomecard/EventCardHome.tsx";
import Discovery from "../components/discovery/Discovery.tsx";
import Carousel from "../components/carousel/Carousel.tsx";

const HomePage = () => {
  return (
    <main className={styles.mainHomepage}>
      <section className={styles.sectionCaroussel}>
        <Carousel />
      </section>
      <section className={styles.sectionDiscovery}>
        <h1 className={styles.popularEvent}>
          Pourquoi s'inscrire sur Event Sphere
        </h1>
        <div className={styles.containerDiscovery}>
          <Discovery
            title={"Découvrez"}
            description={
              "Avec près d’un demi-million d’attractions, d’hôtels et plus encore, vous êtes sûr de trouver la joie."
            }
            imageUrl={"/src/images/decouverte.webp"}
          />
          <Discovery
            title={"Créez"}
            description={
              "Avec près d’un demi-million d’attractions, d’hôtels et plus encore, vous êtes sûr de trouver la joie."
            }
            imageUrl={"/src/images/addLogo.png"}
          />
          <Discovery
            title={"Participez"}
            description={
              "Avec près d’un demi-million d’attractions, d’hôtels et plus encore, vous êtes sûr de trouver la joie."
            }
            imageUrl={"/src/images/calendarLogo.png"}
          />
        </div>
      </section>
      <section className={styles.sectionCards}>
        <h2 className={styles.popularEvent}>A la une</h2>
        <div className={styles.containerCards}>
          <EventCard
            cityName={"Var"}
            eventType={"Sport"}
            eventDate={"02/05/2024"}
            description={"Kayak"}
            imageUrl={"/src/images/var.jpg"}
          />
          <EventCard
            cityName={"Paris"}
            eventType={"Concert"}
            eventDate={"02/05/2024"}
            description={"Concert de Guillaume Pons"}
            imageUrl={"/src/images/paris.jpg"}
          />
          <EventCard
            cityName={"Nouvelle-Aquitaine"}
            eventType={"Sport"}
            eventDate={"02/05/2024"}
            description={"Yoga"}
            imageUrl={"/src/images/bordeaux.jpg"}
          />
        </div>
      </section>
    </main>
  );
};

export default HomePage;
