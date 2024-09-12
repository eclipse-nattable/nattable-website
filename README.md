# NatTable Website

This project contains the sources for the NatTable website hosted at [https://eclipse.dev/nattable/](https://eclipse.dev/nattable/).

It is based on the [hugo-eclipsefdn-website-boilerplate](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-eclipsefdn-website-boilerplate) project, and therefore it is compatible with `Hugo 0.110.0`. For information on the specific supported versions of Hugo, you can refer to the [readme.md](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-solstice-theme#getting-started) of the [Hugo Solstice Theme](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-solstice-theme) project.

## Getting started

Clone the project with submodules and start a web server:

```bash
git clone --recurse-submodules https://github.com/eclipse-nattable/nattable-website.git
cd nattable-website
hugo server
```

### Update hugo-solstice-theme

The [hugo-solstice-theme](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-solstice-theme) was added to this project as a Git submodule. To update it to the latest version call:

```bash
git submodule update --remote
```

Please make sure to keep this sub-module up-to-date if you decide to utilize it. The Eclipse Foundation Webdev team regularly publishes new versions. For more information, please see Git documentation on [submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules).

## Build the website

The preferred static website generator for Eclipse project websites is [Hugo](https://gohugo.io/) and the Eclipse Foundation recommends to Eclipse projects that they get started by creating a copy of the [hugo-eclipsefdn-website-boilerplate](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-eclipsefdn-website-boilerplate) project.

To create and manage the static NatTable website we use the easiest solution and keep both the source and distribution files together in one repository. The "hugo" command will create all the static files for the website in the "public" folder which is committed in this repository. 

The Eclipse Webmaster don't recommend the single Git repo solution if more than one individual is responsible for updating the website. But as currently there is only one maintainer, so the simplest solution is chosen.

### GitLab CI integration

Before deploying your website, rename `.gitlab-ci.template.yml` to `.gitlab-ci.yml`.

Configure your project to support CI integration. Only GitLab project maintainers have access to this setting. Navigate to `Settings` > `General` > `Visibility, project features, permissions`, and ensure that `CI/CD` is checked. Don't forget to save your changes.

Please be aware that the example `.gitlab-ci.template.yml` file makes several assumptions. For instance, it assumes that your project source is in the `main` branch, `deploy` is the targeting branch for generated files and that `push-modification` only runs with manual action. Customize your configuration according to specific requirements and configurations.

## Learn Hugo

If you're new to Hugo, I highly recommend checking out its [documentation](https://gohugo.io/documentation/) to learn how to create pages and customize your site. Although you're starting with [hugo-solstice-theme](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-solstice-theme), remember that Hugo is highly extensible, allowing you to override as much or as little as you need. For example, you may choose to keep our default footer but override our header. You can make as many changes as you want as long as your website continues to adhere to the [Eclipse Foundation Hosted Services Privacy and Acceptable Usage Policy](https://www.eclipse.org/org/documents/eclipse-foundation-hosted-services-privacy-and-acceptable-usage-policy.pdf).

## Contributing

1. [Fork](https://docs.gitlab.com/ee/user/project/repository/forking_workflow.html) the [nattable-website](https://github.com/eclipse-nattable/nattable-website) repository
2. Clone repository: `git clone --recurse-submodules https://github.com/eclipse-nattable/nattable-website.git`
3. Create your feature branch: `git checkout -b my-new-feature`
4. Commit your changes: `git commit -m 'Add some feature' -s`
5. Push feature branch: `git push origin my-new-feature`
6. Submit a pull request

### Declared Project Licenses

This program and the accompanying materials are made available under the terms
of the Eclipse Public License v. 2.0 which is available at
http://www.eclipse.org/legal/epl-2.0.

SPDX-License-Identifier: EPL-2.0

## Related projects

### [solstice-assets](https://gitlab.eclipse.org/eclipsefdn/it/webdev/solstice-assets)

Images, less and JavaScript files for the Eclipse Foundation look and feel.

### [hugo-solstice-theme](https://gitlab.eclipse.org/eclipsefdn/it/webdev/hugo-solstice-theme)

Hugo theme of the Eclipse Foundation look and feel.

## Bugs and feature requests

Have a bug or a feature request? Please search for existing and closed issues. If your problem or idea is not addressed yet, [please open a new issue](https://github.com/eclipse-nattable/nattable-website/issues/new).
