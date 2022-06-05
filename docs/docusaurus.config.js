const lightCodeTheme = require('prism-react-renderer/themes/github');
const darkCodeTheme = require('prism-react-renderer/themes/dracula');

const latestAnnouncement = {
    id: 'announcement_bar',
    content:
        '',
    backgroundColor: '#fafbfc', // Defaults to `#fff`.
    textColor: '#091E42', // Defaults to `#000`.
    isCloseable: false, // Defaults to `true`.
}

/** @type {import('@docusaurus/types').DocusaurusConfig} */
module.exports = {
    title: 'Laravel Mail Editor - MailEclipse',
    tagline: 'MailEclipse ⚡ Laravel Mailable Editor!',
    url: 'https://github.com/Qoraiche/laravel-mail-editor',
    baseUrl: '/',
    onBrokenLinks: 'throw',
    onBrokenMarkdownLinks: 'warn',
    favicon: 'img/favicon.png',
    organizationName: 'Qoraiche', // Usually your GitHub org/user name.
    projectName: 'laravel-mail-editor', // Usually your repo name.
    trailingSlash: false,
    themeConfig: {
        navbar: {
            title: 'MailEclipse',
            logo: {
                alt: 'MailEclipse',
                src: 'https://i.imgur.com/QpAJLql.png',
            },
            items: [
                {
                    type: 'doc',
                    docId: 'intro',
                    position: 'left',
                    label: '📚 Docs',
                },
                { to: '/blog', label: '✍️ Blog', position: 'left' },
                {
                    href: 'https://github.com/Qoraiche/laravel-mail-editor',
                    // label: 'GitHub',
                    title: 'GitHub Repository',
                    className: 'header-github-link',
                    'aria-label': 'GitHub repository',
                    position: 'right',
                },
            ],
        },
        footer: {
            style: 'dark',
            links: [
                {
                    title: 'Docs',
                    items: [
                        {
                            label: 'Tutorial',
                            to: '/docs/intro',
                        },
                    ],
                },
                {
                    title: 'Community',
                    items: [
                        {
                            label: 'Stack Overflow',
                            href: 'https://stackoverflow.com/questions/tagged/maileclipse',
                        },
                        // {
                        //   label: 'Discord',
                        //   href: 'https://discordapp.com/invite/maileclipse',
                        // },
                    ],
                },
                {
                    title: 'More',
                    items: [
                        {
                            label: 'Blog',
                            to: '/blog',
                        },
                        {
                            label: 'GitHub',
                            href: 'https://github.com/Qoraiche/laravel-mail-editor',
                        },
                    ],
                },
            ],
            copyright: `Copyright © ${new Date().getFullYear()} MailEclipse. Built with Docusaurus.`,
        },
        // announcementBar: latestAnnouncement,
        prism: {
            theme: lightCodeTheme,
            darkTheme: darkCodeTheme,
            additionalLanguages: [ 'php' ],
        },
        colorMode: {
            switchConfig: {
                lightIcon: '⚡',
            },
        }
    },
    presets: [
        [
            '@docusaurus/preset-classic',
            {
                docs: {
                    sidebarPath: require.resolve('./sidebars.js'),
                    editUrl:
                        'https://github.com/Qoraiche/laravel-mail-editor/tree/master/docs/docs',
                },
                blog: {
                    showReadingTime: false,
                    editUrl:
                        'https://github.com/Qoraiche/laravel-mail-editor/tree/master/docs/blog',
                },
                theme: {
                    customCss: require.resolve('./src/css/custom.css'),
                },
            },
        ],
    ],
};
