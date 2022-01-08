import React from 'react';
import clsx from 'clsx';
import styles from './SponsorList.module.css';
import DonationList from '../data/donations'
import SponsorList from '../data/sponsors'

function Sponsor({ title, Svg, image, url, description}) {
    return (
        <div className={clsx('col col--4')}>
            <div className="text--center">
                <a href={url}>
                    {
                        Svg ? <Svg className={styles.sponsorImage} alt={title} /> : null
                    }
                    {
                        image ? <img src={image} alt={title} className={styles.sponsorImage}/> : null
                    }
                </a>
            </div>
            <div className="text--center padding-horiz--md">
                <h3>{title}</h3>
                <p>{description}</p>
            </div>
        </div>
    );
}

function Donor({ name, message, amount, date}) {
    return (
        <div className={clsx('col col--4')}>
            <div className="text--center padding-horiz--md">
                <h3>{name}</h3>
                <p>{message}</p>
                <span>{amount}</span>
                <span>{date}</span>
            </div>
        </div>
    );
}

export default function SponsorsList() {
    return (
        <section className={styles.sponsors}>
            <h2>Sponsors</h2>
            <div className="container">
                <div className={`row ${styles.sponsorBlock} shadow--sm`}>
                    {SponsorList.map((props, idx) => (
                        <Sponsor key={idx} {...props} />
                    ))}
                </div>
            </div>
            {/* <br />
            <div className="container">
                <div className="row">
                    {DonationList.map((props, idx) => (
                        <Donor key={idx} {...props} />
                    ))}
                </div>
            </div> */}
        </section>
    );
}
