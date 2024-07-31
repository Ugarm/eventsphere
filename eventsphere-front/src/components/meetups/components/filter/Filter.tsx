import React, { useState } from 'react';
import styles from './filter.module.scss';
import Button from "../../../common/button/Button.tsx";
import {NavLink} from "react-router-dom";

interface FilterProps {
    method: React.Dispatch<React.SetStateAction<boolean>>
    isEvent: boolean
}

const regions = ["Selectionnez une région", "Île-de-France", "Nouvelle-Aquitaine", "Auvergne-Rhône-Alpes"];
const eventTypes = ["Selectionnez un type d'activité", "Musique", "Sport", "Jeu"];
const regionCities = {
    "Île-de-France": ["Paris"],
    "Nouvelle-Aquitaine": ["Bordeaux"],
    "Auvergne-Rhône-Alpes": ["Clermont-Ferrand"]
};

const Filter = ({method, isEvent}: FilterProps) => {
    const [selectedRegion, setSelectedRegion] = useState('');
    const [cities, setCities] = useState([]);
    const [selectedCity, setSelectedCity] = useState('');
    const [selectedEventType, setSelectedEventType] = useState('');

    const handleRegionChange = (event) => {
        const region = event.target.value;
        setSelectedRegion(region);
        setCities(regionCities[region] || []);
        setSelectedCity('');
    };

    return (
        <div className={styles.filterContainer}>
            <div className={styles.filterTitleContainer}>
                <h1 className={styles.filterTitle}>Trouvez les meetups proche de chez vous</h1>
                <h4>Découvrez les activités crées par les membres</h4>
            </div>
            <div className={styles.toggleSwitch}>
                <button
                    className={`${styles.toggleButton} ${isEvent ? styles.active : ''}`}
                    onClick={() => method(true)}
                >
                    Événements
                </button>
                <button
                    className={`${styles.toggleButton} ${!isEvent ? styles.active : ''}`}
                    onClick={() => method(false)}
                >
                    Meetups
                </button>
            </div>
            <select
                className={styles.dropdown}
                value={selectedRegion}
                onChange={handleRegionChange}
            >
                {regions.map((region) => (
                    <option key={region} value={region}>{region}</option>
                ))}
            </select>
            {selectedRegion && (
                <select
                    className={styles.dropdown}
                    value={selectedCity}
                    onChange={(e) => setSelectedCity(e.target.value)}
                >
                    <option value="">Sélectionnez une ville</option>
                    {cities.map((city) => (
                        <option key={city} value={city}>{city}</option>
                    ))}
                </select>
            )}
            <select
                className={styles.dropdown}
                value={selectedEventType}
                onChange={(e) => setSelectedEventType(e.target.value)}
            >
                {eventTypes.map((type) => (
                    <option key={type} value={type}>{type}</option>
                ))}
            </select>
            <div className={styles.searchInputContainer}>
                <input type="text" placeholder="Concert..." className={styles.searchBar} />
                <Button text={"Rechercher"}/>
            </div>
        </div>
    );
};

export default Filter;