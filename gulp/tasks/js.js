import webpack from "webpack-stream";
import ESLintPlugin from 'eslint-webpack-plugin';

export const js = () => {
  return app.gulp
    .src(app.path.src.js, { sourcemaps: app.isDev })
    .pipe(
      webpack({
        mode: app.isBuild ? "production" : "development",
        output: {
          filename: "app.min.js",
        },
        plugins: [
          new ESLintPlugin({
            emitError: true,
            emitWarning: true,
            failOnError: true,
            failOnWarning: false,
          }),
        ],
      })
    )
    .pipe(app.gulp.dest(app.path.build.js))
    .pipe(app.plugins.browserSync.stream());
};
