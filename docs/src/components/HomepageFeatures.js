import React from 'react';
import clsx from 'clsx';
import styles from './HomepageFeatures.module.css';

const FeatureList = [
  {
    title: 'Beginner Friendly',
    Svg: require('../../static/img/undraw_laravel_and_vue_-59-tp.svg').default,
    description: (
      <>
        A beginner friendly way for editing and creating Mailables and editing templates inside a Laravel application.
      </>
    ),
  },
  {
    title: 'Send Test Emails',
    Svg: require('../../static/img/undraw_mail_sent_re_0ofv.svg').default,
    description: (
      <>
        MailEclipse lets you test sending emails before publishing them and using them in production. Get the layout and feel just right.
      </>
    ),
  },
  {
    title: 'Full of Templates',
    Svg: require('../../static/img/template_icon.svg').default,
    description: (
      <>
        MailEclipse comes with predefined templates for various types of emails based on browser friendly and compatible formats.
      </>
    ),
  },
];

function Feature({ Svg, emoji, title, description }) {
  return (
    <div className={clsx('col col--4')}>
      <div className="text--center">
        {Svg ? <Svg className={styles.featureSvg} alt={title} /> : null}
        {emoji
          ? <div className={styles.featureSvg}>{ emoji }</div>
          : null
        }
      </div>
      <div className="text--center padding-horiz--md">
        <h3>{title}</h3>
        <p>{description}</p>
      </div>
    </div>
  );
}

export default function HomepageFeatures() {
  return (
    <section className={styles.features}>
      <div className="container">
        <div className="row flex-justify-content-between">
          {FeatureList.map((props, idx) => (
            <Feature key={idx} {...props} />
          ))}
        </div>
      </div>
    </section>
  );
}
