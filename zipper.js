const fs = require('fs');
const archiver = require('archiver');
const packageJson = require('./package.json');

const archiveName = packageJson.name + '.zip'; // Set the name of the archive based on the package.json name property.

// Check if an archive with the same name already exists, and delete it if it does.
if (fs.existsSync(archiveName)) {
    fs.unlinkSync(archiveName);
    console.log(`Deleted existing archive file: ${archiveName}`);
}

const output = fs.createWriteStream(archiveName);
const archive = archiver('zip', {
    zlib: { level: 9 } // Sets the compression level.
});

// Listen for all archive data to be written.
output.on('close', function () {
    console.log(archive.pointer() + ' total bytes');
    console.log(`archiver has been finalized and the output file ${archiveName} has closed.`);
});

// Listen for progress event and output the percentage completion to the console.
archive.on('progress', function (progress) {
    console.log(`Compressed ${progress.entries.processed} files (${Math.round(progress.fs.processedBytes / 1024)} KB)`);
    console.log(`Total progress: ${Math.round(progress.fs.processedBytes / progress.fs.totalBytes * 100)}%`);
});

// Pipe archive data to the file.
archive.pipe(output);

// Append all files from the root folder to the archive, except for the ones we want to exclude.
archive.glob('**/*', { cwd: __dirname, ignore: ['node_modules/**', '.git/**', 'assets/js', 'assets/sass', 'package-lock.json', '.gitignore', '.gitconfig', 'zipper.js', archiveName] });

// Finalize the archive (i.e., write the central directory).
archive.finalize();