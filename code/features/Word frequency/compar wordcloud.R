att_tweets = searchTwitter("#exercise", n=50)


ver_tweets =searchTwitter("#diet", n=50)

mob_tweets =searchTwitter("#health", n=50)

pcs_tweets =searchTwitter("#sleep", n=50)
att_txt = sapply(att_tweets, function(x) x$getText())
ver_txt = sapply(ver_tweets, function(x) x$getText())
mob_txt = sapply(mob_tweets, function(x) x$getText())
pcs_txt = sapply(pcs_tweets, function(x) x$getText())
clean.text = function(x)
{
   # tolower
   x = tolower(x)
   # remove rt
   x = gsub("rt", "", x)
   # remove at
   x = gsub("@\\w+", "", x)
   # remove punctuation
   x = gsub("[[:punct:]]", "", x)
   # remove numbers
   x = gsub("[[:digit:]]", "", x)
   # remove links http
   x = gsub("http\\w+", "", x)
   # remove tabs
   x = gsub("[ |\t]{2,}", "", x)
   # remove blank spaces at the beginning
   x = gsub("^ ", "", x)
   # remove blank spaces at the end
   x = gsub(" $", "", x)
   return(x)
}
att_clean = clean.text(att_txt)
ver_clean = clean.text(ver_txt)
mob_clean = clean.text(mob_txt)
pcs_clean = clean.text(pcs_txt)
att = paste(att_clean, collapse=" ")
ver = paste(ver_clean, collapse=" ")
mob = paste(mob_clean, collapse=" ")
pcs = paste(pcs_clean, collapse=" ")


all = c(att, ver, mob, pcs)

all = removeWords(all,
c(stopwords("english"), "exercise", "diet", "health", "sleep"))

corpus = Corpus(VectorSource(all))

tdm = TermDocumentMatrix(corpus)

tdm = as.matrix(tdm)


colnames(tdm) = c("EXERCISE", "DIET", "HEALTH", "SLEEP")

comparison.cloud(tdm, random.order=FALSE, 
colors = c("#00B2FF", "red", "#FF0099", "#6600CC"),
title.size=1.5, max.words=500)