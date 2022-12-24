// import { searchPlugin } from "@vuepress/plugin-search";
import { defaultTheme, defineUserConfig } from "vuepress";

export default defineUserConfig({
  lang: "en-US",
  title: "Ubet Pro",
  description: "Just playing around",
  theme: defaultTheme({
    repo: "fahrizalm14/ubet-pro",
    logo: "/images/logo.png",
    docsDir: "app/docs",
    editLinkText: "",
    lastUpdated: false,
    navbar: [
      {
        text: "Guide",
        link: "/guide/",
      },
      {
        text: "Reference",
        children: [
          {
            text: "VuePress",
            children: [
              {
                text: "CLI",
                link: "/reference/cli.html",
              },
              "/reference/config.md",
              "/reference/frontmatter.md",
              "/reference/components.md",
              "/reference/plugin-api.md",
              "/reference/theme-api.md",
              "/reference/client-api.md",
              "/reference/node-api.md",
            ],
          },
          {
            text: "Bundlers",
            children: ["/reference/bundler/vite.md", "/reference/bundler/webpack.md"],
          },
          {
            text: "Default Theme",
            children: [
              "/reference/default-theme/config.md",
              "/reference/default-theme/frontmatter.md",
              "/reference/default-theme/components.md",
              "/reference/default-theme/markdown.md",
              "/reference/default-theme/styles.md",
              "/reference/default-theme/extending.md",
            ],
          },
        ],
      },
      {
        text: "Plugins",
        children: [
          {
            text: "Common Features",
            children: [
              "/reference/plugin/back-to-top.md",
              "/reference/plugin/container.md",
              "/reference/plugin/external-link-icon.md",
              "/reference/plugin/google-analytics.md",
              "/reference/plugin/medium-zoom.md",
              "/reference/plugin/nprogress.md",
              "/reference/plugin/register-components.md",
            ],
          },
          {
            text: "Content Search",
            children: ["/reference/plugin/docsearch.md", "/reference/plugin/search.md"],
          },
          {
            text: "PWA",
            children: ["/reference/plugin/pwa.md", "/reference/plugin/pwa-popup.md"],
          },
          {
            text: "Syntax Highlighting",
            children: ["/reference/plugin/prismjs.md", "/reference/plugin/shiki.md"],
          },
          {
            text: "Theme Development",
            children: [
              "/reference/plugin/active-header-links.md",
              "/reference/plugin/git.md",
              "/reference/plugin/palette.md",
              "/reference/plugin/theme-data.md",
              "/reference/plugin/toc.md",
            ],
          },
        ],
      },
      {
        text: "Learn More",
        children: [
          {
            text: "Advanced",
            children: [
              "/advanced/architecture.md",
              "/advanced/plugin.md",
              "/advanced/theme.md",
              {
                text: "Cookbook",
                link: "/advanced/cookbook/",
              },
            ],
          },
          {
            text: "Resources",
            children: [
              "/contributing.md",
              {
                text: "Awesome VuePress",
                link: "https://github.com/vuepress/awesome-vuepress",
              },
            ],
          },
        ],
      },
      {
        text: `v2.0.1`,
        children: [
          {
            text: "Changelog",
            link: "https://github.com/vuepress/vuepress-next/blob/main/CHANGELOG.md",
          },
          {
            text: "v1.x",
            link: "https://v1.vuepress.vuejs.org",
          },
          {
            text: "v0.x",
            link: "https://v0.vuepress.vuejs.org",
          },
        ],
      },
    ],
    sidebar: {
      "/guide/": [
        {
          text: "Guide",
          children: [
            "/guide/README.md",
            "/guide/getting-started.md",
            "/guide/configuration.md",
            "/guide/page.md",
            "/guide/markdown.md",
            "/guide/assets.md",
            "/guide/i18n.md",
            "/guide/deployment.md",
            "/guide/theme.md",
            "/guide/plugin.md",
            "/guide/bundler.md",
            "/guide/migration.md",
          ],
        },
      ],
      "/advanced/": [
        {
          text: "Advanced",
          children: ["/advanced/architecture.md", "/advanced/plugin.md", "/advanced/theme.md"],
        },
        {
          text: "Cookbook",
          children: [
            "/advanced/cookbook/README.md",
            "/advanced/cookbook/usage-of-client-config.md",
            "/advanced/cookbook/adding-extra-pages.md",
            "/advanced/cookbook/making-a-theme-extendable.md",
            "/advanced/cookbook/passing-data-to-client-code.md",
            "/advanced/cookbook/markdown-and-vue-sfc.md",
          ],
        },
      ],
      "/reference/": [
        {
          text: "VuePress Reference",
          collapsible: true,
          children: [
            "/reference/cli.md",
            "/reference/config.md",
            "/reference/frontmatter.md",
            "/reference/components.md",
            "/reference/plugin-api.md",
            "/reference/theme-api.md",
            "/reference/client-api.md",
            "/reference/node-api.md",
          ],
        },
        {
          text: "Bundlers Reference",
          collapsible: true,
          children: ["/reference/bundler/vite.md", "/reference/bundler/webpack.md"],
        },
        {
          text: "Default Theme Reference",
          collapsible: true,
          children: [
            "/reference/default-theme/config.md",
            "/reference/default-theme/frontmatter.md",
            "/reference/default-theme/components.md",
            "/reference/default-theme/markdown.md",
            "/reference/default-theme/styles.md",
            "/reference/default-theme/extending.md",
          ],
        },
        {
          text: "Official Plugins Reference",
          collapsible: true,
          children: [
            {
              text: "Common Features",
              children: [
                "/reference/plugin/back-to-top.md",
                "/reference/plugin/container.md",
                "/reference/plugin/external-link-icon.md",
                "/reference/plugin/google-analytics.md",
                "/reference/plugin/medium-zoom.md",
                "/reference/plugin/nprogress.md",
                "/reference/plugin/register-components.md",
              ],
            },
            {
              text: "Content Search",
              children: ["/reference/plugin/docsearch.md", "/reference/plugin/search.md"],
            },
            {
              text: "PWA",
              children: ["/reference/plugin/pwa.md", "/reference/plugin/pwa-popup.md"],
            },
            {
              text: "Syntax Highlighting",
              children: ["/reference/plugin/prismjs.md", "/reference/plugin/shiki.md"],
            },
            {
              text: "Theme Development",
              children: [
                "/reference/plugin/active-header-links.md",
                "/reference/plugin/git.md",
                "/reference/plugin/palette.md",
                "/reference/plugin/theme-data.md",
                "/reference/plugin/toc.md",
              ],
            },
          ],
        },
      ],
    },
  }),
  // plugins: [
  //   searchPlugin({
  //     locales: {
  //       "/": {
  //         placeholder: "Search",
  //       },
  //     },
  //   }),
  // ],
});
